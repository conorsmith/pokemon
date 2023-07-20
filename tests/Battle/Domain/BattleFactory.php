<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Battle\Domain\Battle;

final class BattleFactory
{
    public static function create(
        string $id = "dontcare",
        string $trainerId = "dontcare",
        ?CarbonImmutable $dateLastBeaten = null,
        int $battleCount = 0,
    ): Battle
    {
        return new Battle(
            $id,
            $trainerId,
            $dateLastBeaten,
            $battleCount,
        );
    }

    public static function any(): Battle
    {
        return self::create();
    }
}
