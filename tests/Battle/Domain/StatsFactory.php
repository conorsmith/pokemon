<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use ConorSmith\Pokemon\Battle\Domain\Stats;

final class StatsFactory
{
    public static function create(
        int $level = 0,
        int $baseHp = 0,
        int $basePhysicalAttack = 0,
        int $basePhysicalDefence = 0,
        int $baseSpecialAttack = 0,
        int $baseSpecialDefence = 0,
        int $baseSpeed = 0,
        int $ivHp = 0,
        int $ivPhysicalAttack = 0,
        int $ivPhysicalDefence = 0,
        int $ivSpecialAttack = 0,
        int $ivSpecialDefence = 0,
        int $ivSpeed = 0,
        int $evHp = 0,
        int $evPhysicalAttack = 0,
        int $evPhysicalDefence = 0,
        int $evSpecialAttack = 0,
        int $evSpecialDefence = 0,
        int $evSpeed = 0,
    ): Stats {
        return new Stats(
            $level,
            $baseHp,
            $basePhysicalAttack,
            $basePhysicalDefence,
            $baseSpecialAttack,
            $baseSpecialDefence,
            $baseSpeed,
            $ivHp,
            $ivPhysicalAttack,
            $ivPhysicalDefence,
            $ivSpecialAttack,
            $ivSpecialDefence,
            $ivSpeed,
            $evHp,
            $evPhysicalAttack,
            $evPhysicalDefence,
            $evSpecialAttack,
            $evSpecialDefence,
            $evSpeed,
        );
    }

    public static function any(): Stats
    {
        return self::create();
    }
}
