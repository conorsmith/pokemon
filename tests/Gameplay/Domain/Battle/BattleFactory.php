<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Battle;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Battle;

final class BattleFactory
{
    public static function create(
        string $id = "dontcare",
        string $trainerId = "dontcare",
        bool $isPlayerChallenger = true,
        ?CarbonImmutable $dateLastBeaten = null,
        int $battleCount = 0,
    ): Battle
    {
        return new Battle(
            $id,
            $trainerId,
            $isPlayerChallenger,
            $dateLastBeaten,
            $battleCount,
        );
    }

    public static function any(): Battle
    {
        return self::create();
    }
}
