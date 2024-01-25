<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use ConorSmith\Pokemon\Battle\Domain\HeldItem;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;

final class PokemonFactory
{
    public static function create(
        string $id = "dontcare",
        string $number = "1",
        ?string $form = null,
        int $primaryType = PokemonType::NORMAL,
        ?int $secondaryType = null,
        int $level = 0,
        int $friendship = 0,
        Sex $sex = Sex::UNKNOWN,
        bool $isShiny = false,
        Stats $stats = null,
        int $remainingHp = 0,
        bool $hasFainted = false,
        ?HeldItem $heldItem = null,
    ): Pokemon {
        return new Pokemon(
            $id,
            $number,
            $form,
            $primaryType,
            $secondaryType,
            $level,
            $friendship,
            $sex,
            $isShiny,
            $stats ?? StatsFactory::any(),
            $remainingHp,
            $hasFainted,
            $heldItem,
        );
    }

    public static function any(): Pokemon
    {
        return self::create();
    }
}
