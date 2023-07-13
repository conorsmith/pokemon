<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Domain;

use ConorSmith\Pokemon\Team\Domain\Egg;

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
            $ivHp,
            $ivPhysicalAttack,
            $ivPhysicalDefence,
            $ivSpecialAttack,
            $ivSpecialDefence,
            $ivSpeed,
            $firstParentId,
            $secondParentId,
            $remainingCycles,
        );
    }

    public static function any(): Egg
    {
        return self::create();
    }
}
