<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Evolution\Evolution;
use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use Exception;
use LogicException;

final class LevelUpPokemon
{
    public function __construct(
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly LocationRepository $locationRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly EvolutionRepository $evolutionRepository,
        private readonly FriendshipEventLogRepository $friendshipLog,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function run(string $pokemonId): LevelUpPokemonResult
    {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            throw new Exception("Pokémon not found");
        }

        $highestRankedGymBadge = $this->gymBadgeRepository->findHighestRanked();

        $newLevel = self::calculateNewLevel($pokemon->level, $highestRankedGymBadge->levelLimit());

        if ($newLevel > $highestRankedGymBadge->levelLimit()) {
            return LevelUpPokemonResult::beyondLevelLimit($highestRankedGymBadge->levelLimit());
        }

        $pokemonEvolves = false;
        $evolutions = $this->evolutionRepository->findAllForPokemon($pokemon);

        $triggeredEvolutions = [];

        /** @var Evolution $evolution */
        foreach ($evolutions as $evolution) {
            if ($evolution->isTriggered($pokemon, $newLevel)) {
                $triggeredEvolutions[] = $evolution;
            }
        }

        if (count($triggeredEvolutions) === 1) {
            $pokemonEvolves = true;
            $pokemon = $pokemon->evolve($triggeredEvolutions[0]->evolvedPokedexNumber);

        } elseif (count($triggeredEvolutions) > 1) {
            foreach ($triggeredEvolutions as $triggeredEvolution) {
                if (!$triggeredEvolution->isRandom()) {
                    throw new LogicException("Multiple evolutions found that are not configured for random selection");
                }
            }

            $randomlySelectedEvolution = RandomNumberGenerator::selectFromArray($triggeredEvolutions);

            $pokemonEvolves = true;
            $pokemon = $pokemon->evolve($randomlySelectedEvolution->evolvedPokedexNumber);
        }

        $pokemon = $pokemon->levelUp($newLevel);
        $this->friendshipLog->levelUp($pokemon);

        $this->pokemonRepository->save($pokemon);

        if ($pokemonEvolves) {
            $newPokedexEntry = $this->pokedexEntryRepository->register($pokemon->number, $pokemon->form);

            if ($pokemon->number === PokedexNo::NINJASK) {

                $regionalLevelOffset = match ($pokemon->caughtLocation->region) {
                    RegionId::KANTO => 0,
                    RegionId::JOHTO => 50,
                    RegionId::HOENN => 100,
                    default         => throw new LogicException(),
                };

                $party = $this->pokemonRepository->getParty();

                $this->addNewPokemon->run(
                    PokedexNo::SHEDINJA,
                    null,
                    5 + $regionalLevelOffset,
                    $this->generateSex(PokedexNo::SHEDINJA),
                    $this->generateShininess(),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    RandomNumberGenerator::generateInRange(0, 31),
                    $this->locationRepository->findCurrentLocation()->id,
                    $party->isFull() ? null : $party->getNextOpenPosition(),
                );

                return LevelUpPokemonResult::nincadaEvolvedIntoNinjask($pokemon->level, $newPokedexEntry);
            }
        }

        return $pokemonEvolves
            ? LevelUpPokemonResult::levelledUpAndEvolved($pokemon->level, $pokemon->number, $newPokedexEntry)
            : LevelUpPokemonResult::levelledUp($pokemon->level);
    }

    public static function calculateNewLevel(int $currentLevel, int $levelLimit): int
    {
        $allLevelLimits = array_map(
            fn(GymBadge $gymBadge) => $gymBadge->levelLimit(),
            GymBadge::all(),
        );

        $distinctLevelLimits = array_unique($allLevelLimits);
        sort($distinctLevelLimits);

        $previousLevelLimits = array_filter(
            $distinctLevelLimits,
            fn(int $possibleLevelLimit) => $possibleLevelLimit < $levelLimit,
        );

        $mostRecentLevelLimit = array_pop($previousLevelLimits);
        $secondMostRecentLevelLimit = array_pop($previousLevelLimits);
        $thirdMostRecentLevelLimit = array_pop($previousLevelLimits);

        $remainingRecentLevelLimits = $previousLevelLimits;

        foreach ($remainingRecentLevelLimits as $recentLevelLimit) {
            if ($currentLevel < $recentLevelLimit) {
                return $recentLevelLimit;
            }
        }

        if ($currentLevel < $thirdMostRecentLevelLimit) {
            return min($currentLevel + 10, $thirdMostRecentLevelLimit);

        } elseif ($currentLevel < $secondMostRecentLevelLimit) {
            return min($currentLevel + 2, $secondMostRecentLevelLimit);

        } elseif ($currentLevel < $mostRecentLevelLimit) {
            return min($currentLevel + 1, $mostRecentLevelLimit);

        } else {
            return $currentLevel + 1;
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
