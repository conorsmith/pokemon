<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Domain;

use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\Team\Domain\Egg;

final class EggFactory
{
    public static function any(): Egg
    {
        return new Egg(
            "1",
            Sex::UNKNOWN,
            "1",
            Sex::UNKNOWN,
            0,
        );
    }
}
