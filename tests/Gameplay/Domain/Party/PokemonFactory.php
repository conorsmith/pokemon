<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Party;

use ConorSmith\Pokemon\Gameplay\Domain\Party\CaughtLocation;
use ConorSmith\Pokemon\Gameplay\Domain\Breeding\EggGroup;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggGroups;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Hp;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stat;
use ConorSmith\Pokemon\Gameplay\Domain\PartyAssessment\Type;
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
            null,
        );
    }

    public static function any(): Pokemon
    {
        return self::create();
    }
}
