<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\Domain\Egg;
use ConorSmith\Pokemon\Team\Domain\EggRepository;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\BreedingPokemon;
use LogicException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPokemonBreed
{
    public function __construct(
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly EggRepository $eggRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonAId = $args['id'];
        $pokemonBId = $request->request->get("pokemon");

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::OVAL_CHARM)) {
            $this->session->getFlashBag()->add("errors", "No oval charms remaining");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $pokemonA = $this->pokemonRepository->find($pokemonAId);
        $pokemonB = $this->pokemonRepository->find($pokemonBId);

        if (is_null($pokemonA) || is_null($pokemonB)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        if (!$pokemonA->canBreedWith($pokemonB)) {
            $this->session->getFlashBag()->add("errors", "Attempt to breed incompatible pokémon");
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

            $this->session->getFlashBag()->add("errors", "{$pokemonAVm->name} and {$pokemonBVm->name} did not bear any eggs");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $speciesParent = self::determineSpeciesParent($pokemonA, $pokemonB);
        $eggPokedexNumber = $this->findFirstStageOfEvolutionaryLine($speciesParent->number);
        $ivs = self::generateIvs($pokemonA, $pokemonB);

        $egg = new Egg(
            Uuid::uuid4()->toString(),
            $eggPokedexNumber,
            $speciesParent->form,
            $ivs['hp'],
            $ivs['physicalAttack'],
            $ivs['physicalDefence'],
            $ivs['specialAttack'],
            $ivs['specialDefence'],
            $ivs['speed'],
            $pokemonA->number,
            $pokemonA->sex,
            $pokemonB->number,
            $pokemonB->sex,
            $this->pokedexConfigRepository->find($eggPokedexNumber)['eggCycles'],
        );

        $this->bagRepository->save($bag);
        $this->eggRepository->save($egg);

        $pokemonAVm = BreedingPokemon::create($pokemonA);
        $pokemonBVm = BreedingPokemon::create($pokemonB);

        $this->session->getFlashBag()->add("successes", "{$pokemonAVm->name} and {$pokemonBVm->name} bore an egg!");
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

    private static function generateIvs(Pokemon $pokemonA, Pokemon $pokemonB): array
    {
        $statKeys =  ['hp', 'physicalAttack', 'physicalDefence', 'specialAttack', 'specialDefence', 'speed'];

        $inheritedStatKeys = array_map(
            fn(int $i) => $statKeys[$i],
            array_rand($statKeys, 3)
        );

        $stats = [];

        foreach ($statKeys as $statKey) {
            if (in_array($statKey, $inheritedStatKeys)) {
                $stats[$statKey] = RandomNumberGenerator::generateInRange(0, 1) === 0
                    ? $pokemonA->{$statKey}->iv
                    : $pokemonB->{$statKey}->iv;
            } else {
                $stats[$statKey] = RandomNumberGenerator::generateInRange(0, 31);
            }
        }

        return $stats;
    }
}
