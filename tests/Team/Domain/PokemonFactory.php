<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Domain;

use ConorSmith\Pokemon\EggGroup;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\Team\Domain\CaughtLocation;
use ConorSmith\Pokemon\Team\Domain\EggGroups;
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
            new EggGroups(EggGroup::NO_EGGS_DISCOVERED, null),
            0,
            0,
            Sex::UNKNOWN,
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
