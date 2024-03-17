<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra;

use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Breeding\GenealogyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Breeding\ParentalRelationship;
use ConorSmith\Pokemon\Gameplay\App\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\BreedingPokemon;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Commands\ReduceEggCyclesCommand as CommandInterface;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use Exception;

final class ReduceEggCyclesCommand implements CommandInterface
{
    public function __construct(
        private readonly EggRepository $eggRepository,
        private readonly GenealogyRepository $genealogyRepository,
        private readonly LocationRepository $locationRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly FriendshipEventLogRepository $friendshipLog,
    ) {}

    public function run(int $amount): void
    {
        $eggs = $this->eggRepository->all();

        /** @var Egg $egg */
        foreach ($eggs as $egg) {
            $this->updateEgg($egg, $amount);
        }
    }

    private function updateEgg(Egg $egg, int $amount): void
    {
        $egg = $egg->reduceCycles($amount);

        if (!$egg->canHatch()) {
            $this->eggRepository->save($egg);
            return;
        }

        $totalRegisteredPokemonBeforeHatching = count(array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        ));

        $party = $this->pokemonRepository->getParty();

        $pokemon = $this->addNewPokemon->run(
            $egg->pokedexNumber,
            $egg->form,
            5,
            $this->generateSex($egg->pokedexNumber),
            $this->generateShininess(),
            $egg->ivs->hp,
            $egg->ivs->physicalAttack,
            $egg->ivs->physicalDefence,
            $egg->ivs->specialAttack,
            $egg->ivs->specialDefence,
            $egg->ivs->speed,
            $this->locationRepository->findCurrentLocation()->id,
            $party->isFull() ? null : $party->getNextOpenPosition(),
        );

        if ($egg->hasKnownParents()) {
            $this->genealogyRepository->add(new ParentalRelationship(
                $pokemon->id,
                $egg->parents->firstParentId,
                $egg->parents->secondParentId,
            ));
        }

        $this->eggRepository->remove($egg);

        $totalRegisteredPokemonAfterHatching = count(array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        ));

        $this->friendshipLog->sentToBox($pokemon);

        $pokemonVm = BreedingPokemon::create($pokemon);
        $this->notifyPlayerCommand->run(
            Notification::persistent("{$pokemonVm->name} hatched from an egg!")
        );

        if ($totalRegisteredPokemonAfterHatching > $totalRegisteredPokemonBeforeHatching) {
            $this->notifyPlayerCommand->run(
                Notification::persistent("{$pokemonVm->name} has been registered in your Pokédex")
            );
        }
    }

    private function generateSex(string $pokedexNumber): Sex
    {
        $pokedexConfig = $this->pokedexConfigRepository->find($pokedexNumber);

        if (count($pokedexConfig['sexRatio']) === 1) {
            return $pokedexConfig['sexRatio'][0]['sex'];
        }

        return self::randomlySelectSex($pokedexConfig['sexRatio']);
    }

    private static function randomlySelectSex(array $sexRatioConfig): Sex
    {
        $aggregatedWeight = array_reduce(
            $sexRatioConfig,
            function ($carry, array $sexRatioEntry) {
                return $carry + $sexRatioEntry['weight'];
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var array $sexRatioEntry */
        foreach ($sexRatioConfig as $sexRatioEntry) {
            $randomlySelectedValue -= $sexRatioEntry['weight'];
            if ($randomlySelectedValue <= 0) {
                return $sexRatioEntry['sex'];
            }
        }

        throw new Exception;
    }

    private function generateShininess(): bool
    {
        $streak = $this->habitStreakQuery->run();

        $divisor = $streak < 7 ? self::curveBeforeOneWeek($streak) : self::curveAfterOneWeek($streak);

        $odds = intval(round(4096 / $divisor));

        return mt_rand(1, $odds) === 1;
    }

    private static function curveBeforeOneWeek(int $i): float
    {
        return 0.480898 * log(8 * ($i + 1));
    }

    private static function curveAfterOneWeek(int $i): float
    {
        return 3.54073 * log(0.251313 * $i);
    }
}
