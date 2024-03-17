<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewEgg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggParents;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stats;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\BreedingPokemon;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPokemonBreed
{
    public function __construct(
        private readonly AddNewEgg $addNewEgg,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonAId = $args['id'];
        $pokemonBId = $request->request->get("pokemon");

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::OVAL_CHARM)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No oval charms remaining")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $pokemonA = $this->pokemonRepository->find($pokemonAId);
        $pokemonB = $this->pokemonRepository->find($pokemonBId);

        if (is_null($pokemonA) || is_null($pokemonB)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        if (!$pokemonA->canBreedWith($pokemonB)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Attempt to breed incompatible pokémon")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $bag = $bag->use(ItemId::OVAL_CHARM);

        if ($pokemonA->number === $pokemonB->number) {
            $percentageChance = 80;
        } else {
            $percentageChance = 60;
        }

        if (RandomNumberGenerator::generateInRange(1, 100) > $percentageChance) {

            $this->bagRepository->save($bag);

            $pokemonAVm = BreedingPokemon::create($pokemonA);
            $pokemonBVm = BreedingPokemon::create($pokemonB);

            $this->notifyPlayerCommand->run(
                Notification::persistent("{$pokemonAVm->name} and {$pokemonBVm->name} did not bear any eggs")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $speciesParent = self::determineSpeciesParent($pokemonA, $pokemonB);

        if ($speciesParent->number === PokedexNo::NIDORAN_F
            || $speciesParent->number === PokedexNo::NIDORAN_M
            || $speciesParent->number === PokedexNo::NIDORINO
            || $speciesParent->number === PokedexNo::NIDOKING
        ) {
            $eggPokedexNumber = RandomNumberGenerator::coinToss()
                ? PokedexNo::NIDORAN_F
                : PokedexNo::NIDORAN_M;

        } elseif ($speciesParent->number === PokedexNo::ILLUMISE
            || $speciesParent->number === PokedexNo::VOLBEAT
        ) {
            $eggPokedexNumber = RandomNumberGenerator::coinToss()
                ? PokedexNo::ILLUMISE
                : PokedexNo::VOLBEAT;

        } elseif ($speciesParent->number === PokedexNo::MANAPHY) {
            $eggPokedexNumber = PokedexNo::PHIONE;

        } else {
            $eggPokedexNumber = $this->findFirstStageOfEvolutionaryLine($speciesParent->number);
        }

        $ivs = self::generateIvs($pokemonA, $pokemonB);

        $this->addNewEgg->run(
            $eggPokedexNumber,
            $speciesParent->form,
            $ivs,
            new EggParents(
                $pokemonA->id,
                $pokemonB->id,
            ),
        );

        $this->bagRepository->save($bag);

        $pokemonAVm = BreedingPokemon::create($pokemonA);
        $pokemonBVm = BreedingPokemon::create($pokemonB);

        $this->notifyPlayerCommand->run(
            Notification::persistent("{$pokemonAVm->name} and {$pokemonBVm->name} bore an egg!")
        );
        return new RedirectResponse("/{$instanceId}/bag");
    }

    private static function determineSpeciesParent(Pokemon $pokemonA, Pokemon $pokemonB): Pokemon
    {
        if ($pokemonA->eggGroups->isDitto()) {
            return $pokemonB;
        } elseif ($pokemonB->eggGroups->isDitto()) {
            return $pokemonA;
        } elseif ($pokemonA->sex === Sex::FEMALE) {
            return $pokemonA;
        } elseif ($pokemonB->sex === Sex::FEMALE) {
            return $pokemonB;
        } else {
            throw new LogicException();
        }
    }

    private function findFirstStageOfEvolutionaryLine(string $pokedexNumber): string
    {
        $candidates = [];

        while (!is_null($pokedexNumber)) {
            $candidates[] = $pokedexNumber;
            $pokedexNumber = $this->findPreviousStageOfEvolutionaryLine($pokedexNumber);
        }

        return array_pop($candidates);
    }

    private function findPreviousStageOfEvolutionaryLine(string $pokedexNumber): ?string
    {
        foreach ($this->pokedexConfigRepository->all() as $previousStagePokedexNumber => $entry) {
            if (!isset($entry['evolutions'])) {
                continue;
            }

            foreach ($entry['evolutions'] as $evolutionPokedexNumber => $evolutionConfig) {
                if (strval($evolutionPokedexNumber) === $pokedexNumber) {
                    return strval($previousStagePokedexNumber);
                }
            }
        }

        return null;
    }

    private static function generateIvs(Pokemon $pokemonA, Pokemon $pokemonB): Stats
    {
        $statKeys = ['hp', 'physicalAttack', 'physicalDefence', 'specialAttack', 'specialDefence', 'speed'];

        $inheritedStatKeys = array_map(
            fn(int $i) => $statKeys[$i],
            array_rand($statKeys, 3)
        );

        $stats = [];

        foreach ($statKeys as $statKey) {
            if (in_array($statKey, $inheritedStatKeys)) {
                $stats[$statKey] = RandomNumberGenerator::coinToss()
                    ? $pokemonA->{$statKey}->iv
                    : $pokemonB->{$statKey}->iv;
            } else {
                $stats[$statKey] = RandomNumberGenerator::generateInRange(0, 31);
            }
        }

        return new Stats(
            $stats['hp'],
            $stats['physicalAttack'],
            $stats['physicalDefence'],
            $stats['specialAttack'],
            $stats['specialDefence'],
            $stats['speed'],
        );
    }
}
