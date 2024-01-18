<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;

final class StatsFactory
{
    public static function createStats(
        int $level,
        array $pokedexEntry,
        StatsIv $ivs
    ): Stats {

        $baseStats = $pokedexEntry['stats'];

        return new Stats(
            $level,
            $baseStats['hp'],
            $baseStats['attack'],
            $baseStats['defence'],
            $baseStats['spAttack'],
            $baseStats['spDefence'],
            $baseStats['speed'],
            $ivs,
            0,
            0,
            0,
            0,
            0,
            0,
        );
    }

    public static function generateIvsForTrainerClass(string $trainerClass): StatsIv
    {
        return new StatsIv(
            self::generateIvForTrainerClass($trainerClass),
            self::generateIvForTrainerClass($trainerClass),
            self::generateIvForTrainerClass($trainerClass),
            self::generateIvForTrainerClass($trainerClass),
            self::generateIvForTrainerClass($trainerClass),
            self::generateIvForTrainerClass($trainerClass),
        );
    }

    private static function generateIvForTrainerClass(string $trainerClass): int
    {
        $weightedDistribution = TrainerClass::getWeightedDistributionForIvs($trainerClass);

        if (is_null($weightedDistribution)) {
            return RandomNumberGenerator::generateInRange(0, 31);
        }

        return RandomNumberGenerator::generateFromWeightedTable($weightedDistribution);
    }

    public static function generateIvsForEncounteredPokemon(): StatsIv
    {
        return new StatsIv(
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
        );
    }
}
