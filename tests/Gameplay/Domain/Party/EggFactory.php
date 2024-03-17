<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Party;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggParents;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stats;

final class EggFactory
{
    public static function create(
        string $id = "dontcare",
        string $pokedexNumber = "dontcare",
        ?string $form = null,
        int $ivHp = 0,
        int $ivPhysicalAttack = 0,
        int $ivPhysicalDefence = 0,
        int $ivSpecialAttack = 0,
        int $ivSpecialDefence = 0,
        int $ivSpeed = 0,
        string $firstParentId = "dontcare",
        string $secondParentId = "dontcare",
        int $remainingCycles = 0,
    ) {
        return new Egg(
            $id,
            $pokedexNumber,
            $form,
            new Stats(
                $ivHp,
                $ivPhysicalAttack,
                $ivPhysicalDefence,
                $ivSpecialAttack,
                $ivSpecialDefence,
                $ivSpeed,
            ),
            new EggParents(
                $firstParentId,
                $secondParentId,
            ),
            $remainingCycles,
        );
    }

    public static function any(): Egg
    {
        return self::create();
    }
}
