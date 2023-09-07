<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Party\Domain;

use ConorSmith\Pokemon\Party\Domain\CaughtLocation;
use ConorSmith\Pokemon\Party\Domain\EggGroup;
use ConorSmith\Pokemon\Party\Domain\EggGroups;
use ConorSmith\Pokemon\Party\Domain\Hp;
use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\Stat;
use ConorSmith\Pokemon\Party\Domain\Type;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;

final class PokemonFactory
{
    public static function create(
        string $id = "dontcare",
        string $number = "1",
        ?string $form = "dontcare",
        Type $type = new Type(0, 0),
        EggGroups $eggGroups = new EggGroups(EggGroup::NO_EGGS_DISCOVERED, null),
        int $level = 0,
        int $friendship = 0,
        Sex $sex = Sex::UNKNOWN,
        bool $isShiny = false,
        Hp $hp = new Hp(0, 0, 0),
        Stat $physicalAttack = new Stat(0, 0, 0),
        Stat $physicalDefence = new Stat(0, 0, 0),
        Stat $specialAttack = new Stat(0, 0, 0),
        Stat $specialDefence = new Stat(0, 0, 0),
        Stat $speed = new Stat(0, 0, 0),
        CaughtLocation $caughtLocation = new CaughtLocation("dontcare", RegionId::KANTO),
    ): Pokemon {
        return new Pokemon(
            $id,
            $number,
            $form,
            $type,
            $eggGroups,
            $level,
            $friendship,
            $sex,
            $isShiny,
            $hp,
            $physicalAttack,
            $physicalDefence,
            $specialAttack,
            $specialDefence,
            $speed,
            $caughtLocation,
        );
    }

    public static function any(): Pokemon
    {
        return self::create();
    }
}
