<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\Evolution;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonSpecies;
use ConorSmith\Pokemon\Import\Domain\PokemonType;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\PokemonType as SharedKernelPokemonType;
use Exception;
use ReflectionClass;

final class PokemonSpeciesFactory
{
    public function createFromBulbapedia(array $bulbapediaPokemon): PokemonSpecies
    {
        return new PokemonSpecies(
            new PokedexNumber($bulbapediaPokemon['pokedexNumber']),
            $bulbapediaPokemon['name'],
            self::createTypeFromBulbapedia($bulbapediaPokemon['types']),
            self::createEvolutionsFromBulbapedia($bulbapediaPokemon['evolutions']),
            intval($bulbapediaPokemon['friendship']),
        );
    }

    private static function createTypeFromBulbapedia(array $bulbapediaType): PokemonType
    {
        return new PokemonType(
            self::typeValueFromName($bulbapediaType[0]),
            isset($bulbapediaType[1]) ? self::typeValueFromName($bulbapediaType[1]) : null,
        );
    }

    private static function typeValueFromName(string $name): int
    {
        $reflector = new ReflectionClass(SharedKernelPokemonType::class);

        $typeConstants = array_filter(
            $reflector->getConstants(),
            fn($value) => is_int($value),
        );

        if (!isset($typeConstants[strtoupper($name)])) {
            throw new Exception;
        }

        return $typeConstants[strtoupper($name)];
    }

    private static function createEvolutionsFromBulbapedia(array $bulbapediaEvolutions): array
    {
        $evolutions = [];

        /** @var array $bulbapediaEvolution */
        foreach ($bulbapediaEvolutions as $bulbapediaEvolution) {
            $evolutions[] = new Evolution(
                self::createPokedexNumberFromPokemonName($bulbapediaEvolution['name']),
                isset($bulbapediaEvolution['level']) ? intval($bulbapediaEvolution['level']) : null,
                $bulbapediaEvolution['item'] ?? null,
                isset($bulbapediaEvolution['friendship']),
                $bulbapediaEvolution['move'] ?? null,
                $bulbapediaEvolution['time'] ?? null,
                isset($bulbapediaEvolution['holding']) ? self::createHoldingItemIdFromName($bulbapediaEvolution['holding']) : null,
                $bulbapediaEvolution['stats'] ?? null,
                isset($bulbapediaEvolution['randomly']),
                $bulbapediaEvolution['gender'] ?? null,
            );
        }

        return $evolutions;
    }

    private static function createPokedexNumberFromPokemonName(string $name): PokedexNumber
    {
        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);

        $name = strtoupper($name);
        $name = str_replace("-", "_", $name);

        return new PokedexNumber(
            $pokedexNoReflector->getConstants()[$name],
        );
    }

    private static function createHoldingItemIdFromName(?string $name): string
    {
        $reflector = new ReflectionClass(ItemId::class);

        $name = strtoupper($name);
        $name = str_replace(" ", "_", $name);

        return $reflector->getConstants()[$name];
    }
}