<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\Team\Domain\CaughtLocation;
use ConorSmith\Pokemon\Team\Domain\Hp;
use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\Stat;
use ConorSmith\Pokemon\Team\Domain\Type;

final class PokemonFactory
{
    public static function any(): Pokemon
    {
        return new Pokemon(
            "dontcare",
            "1",
            "dontcare",
            new Type(0, 0),
            0,
            0,
            false,
            new Hp(0, 0, 0),
            new Stat(0, 0, 0),
            new Stat(0, 0, 0),
            new Stat(0, 0, 0),
            new Stat(0, 0, 0),
            new Stat(0, 0, 0),
            new CaughtLocation("dontcare", RegionId::KANTO),
        );
    }
}
