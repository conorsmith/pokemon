<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\EggGroup;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEggGroups;
use RuntimeException;

final class PokemonEggGroupsFactory
{
    public static function fromBulbapediaEntry(array $bulbapediaEntry): ?PokemonEggGroups
    {
        return new PokemonEggGroups(
            new PokedexNumber(strval(intval($bulbapediaEntry['pokedexNumber']))),
            self::createEggGroup($bulbapediaEntry['group1']),
            self::createEggGroup($bulbapediaEntry['group2']),
        );
    }

    private static function createEggGroup(string $bulbapediaValue): ?EggGroup
    {
        $value = match ($bulbapediaValue) {
            "Monster" => "MONSTER",
            "Grass" => "GRASS",
            "Dragon" => "DRAGON",
            "Water 1" => "WATER_1",
            "Bug" => "BUG",
            "Flying" => "FLYING",
            "Field" => "FIELD",
            "No Eggs Discovered" => "NO_EGGS_DISCOVERED",
            "Fairy" => "FAIRY",
            "Human-Like" => "HUMAN_LIKE",
            "Water 3" => "WATER_3",
            "Mineral" => "MINERAL",
            "Amorphous" => "AMORPHOUS",
            "Water 2" => "WATER_2",
            "Ditto" => "DITTO",
            "Human-Like*" => "HUMAN_LIKE",
            "Dragon*" => "DRAGON",
            "Flying*" => "FLYING",
            "Mineral*" => "MINERAL",
            "—" => null,
            default => throw new RuntimeException(),
        };

        if (is_null($value)) {
            return null;
        }

        return new EggGroup($value);
    }
}
