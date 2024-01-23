<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Party\Domain\Evolution;
use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Party\UseCases\AddNewPokemon;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Queries\CurrentLocationQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\HighestRankedGymBadgeQuery;
use Doctrine\DBAL\Connection;
use Exception;
use LogicException;
use Ramsey\Uuid\Uuid;

final class LevelUpPokemon
{
    public function __construct(
        private readonly Connection $db,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly EvolutionRepository $evolutionRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly CurrentLocationQuery $currentLocationQuery,
        private readonly AddNewPokemon $addNewPokemon,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function run(string $pokemonId): ResultOfLevellingUp
    {
        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            throw new Exception("Pokémon not found");
        }

        $highestRankedGymBadge = $this->highestRankedGymBadgeQuery->run();

        $newLevel = self::calculateNewLevel($pokemon->level, $highestRankedGymBadge->levelLimit());

        if ($newLevel > $highestRankedGymBadge->levelLimit()) {
            return ResultOfLevellingUp::beyondLevelLimit($highestRankedGymBadge->levelLimit());
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

        $this->db->beginTransaction();

        $this->pokemonRepository->save($pokemon);

        if ($pokemonEvolves) {
            $newPokedexEntry = $this->addPokedexEntryIfNecessary($pokemon);

            if ($pokemon->number === PokedexNo::NINJASK) {

                $regionalLevelOffset = match ($pokemon->caughtLocation->region) {
                    RegionId::KANTO => 0,
                    RegionId::JOHTO => 50,
                    RegionId::HOENN => 100,
                    default         => throw new LogicException(),
                };

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
                    $this->currentLocationQuery->run(),
                    null,
                );

                $this->db->commit();

                return ResultOfLevellingUp::nincadaEvolvedIntoNinjask($pokemon->level, $newPokedexEntry);
            }
        }

        $this->db->commit();

        return $pokemonEvolves
            ? ResultOfLevellingUp::levelledUpAndEvolved($pokemon->level, $pokemon->number, $newPokedexEntry)
            : ResultOfLevellingUp::levelledUp($pokemon->level);
    }

    private function addPokedexEntryIfNecessary(Pokemon $pokemon): bool
    {
        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number'     => $pokemon->number,
        ]);

        if ($pokedexRow !== false) {
            return false;
        }

        $this->db->insert("pokedex_entries", [
            'id'          => Uuid::uuid4(),
            'instance_id' => $this->instanceId->value,
            'number'      => $pokemon->number,
            'date_added'  => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        ]);

        return true;
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
