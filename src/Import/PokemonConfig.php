<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\Evolution;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonSpecies;
use ConorSmith\Pokemon\Import\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo as PokedexNumberConstants;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType as PokemonTypeConstants;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType as SharedKernelPokemonType;
use LogicException;
use ReflectionClass;

final class PokemonConfig
{
    public static function fromPokemonSpecies(PokemonSpecies $pokemonSpecies): string
    {
        $config = "";

        $config .= self::encodePokedexNumber($pokemonSpecies->pokedexNumber) . " => [" . PHP_EOL;
        $config .= "    'name' => \"{$pokemonSpecies->name}\"," . PHP_EOL;
        $config .= "    'type' => " . self::encodeType($pokemonSpecies->type) . "," . PHP_EOL;

        if ($pokemonSpecies->hasEvolutions()) {
            $config .= "    'evolutions' => [" . PHP_EOL;
            /** @var Evolution $evolution */
            foreach ($pokemonSpecies->evolutions as $evolution) {
                $config .= self::encodeEvolution($evolution);
            }
            $config .= "    ]," . PHP_EOL;
        }

        if ($pokemonSpecies->friendship != 70) {
            $config .= "    'friendship' => {$pokemonSpecies->friendship}," . PHP_EOL;
        }

        $config .= "]," . PHP_EOL;

        return $config;
    }

    private static function encodePokedexNumber(PokedexNumber $pokedexNumber): string
    {
        $reflector = new ReflectionClass(PokedexNumberConstants::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$pokedexNumber->value];
    }

    private static function encodeType(PokemonType $type): string
    {
        $reflector = new ReflectionClass(SharedKernelPokemonType::class);

        $typeConstants = array_filter(
            $reflector->getConstants(),
            fn($value) => is_int($value),
        );

        $typeConstants = array_flip($typeConstants);

        $config = "[";

        $config .= $reflector->getShortName() . "::" . $typeConstants[$type->primaryType];

        if ($type->hasSecondaryType()) {
            $config .= ", ";
            $config .= $reflector->getShortName() . "::" . $typeConstants[$type->secondaryType];
        }

        $config .= "]";

        return $config;
    }

    private static function encodeEvolution(Evolution $evolution): string
    {
        $config = "";

        $config .= "        " . self::encodePokedexNumber($evolution->pokedexNumber) . " => [" . PHP_EOL;

        if (!is_null($evolution->level)) {
            $config .= "            'level' => {$evolution->level}," . PHP_EOL;
        }

        if (!is_null($evolution->itemId)) {
            $config .= "            'item' => " . self::encodeItemId($evolution->itemId) . "," . PHP_EOL;
        }

        if ($evolution->highFriendship) {
            $config .= "            'friendship'," . PHP_EOL;
        }

        if (!is_null($evolution->move)) {
            $config .= "            'move' => " . self::encodeMove($evolution->move) . "," . PHP_EOL;
        }

        if (!is_null($evolution->holding)) {
            $config .= "            'holding' => " . self::encodeItemId($evolution->holding) . "," . PHP_EOL;
        }

        if (!is_null($evolution->time)) {
            $config .= "            'time' => \"{$evolution->time}\"," . PHP_EOL;
        }

        if (!is_null($evolution->stats)) {
            $config .= "            'stats' => \"{$evolution->stats}\"," . PHP_EOL;
        }

        if (!is_null($evolution->gender)) {
            $config .= "            'gender' => " . self::encodeGender($evolution->gender) . "," . PHP_EOL;
        }

        if ($evolution->randomly) {
            $config .= "            'randomly'," . PHP_EOL;
        }

        $config .= "        ]," . PHP_EOL;

        return $config;
    }

    private static function encodeItemId(string $itemId): string
    {
        $reflector = new ReflectionClass(ItemId::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$itemId];
    }

    private static function encodeMove(string|int $move): string
    {
        if (is_string($move)) {
            return "\"{$move}\"";
        }

        $reflector = new ReflectionClass(PokemonTypeConstants::class);
        $constants = $reflector->getConstants();
        unset($constants['MULTIPLIERS']);
        $constants = array_flip($constants);

        return $reflector->getShortName() . "::" . $constants[$move];
    }

    private static function encodeGender(string $gender): string
    {
        return match ($gender) {
            'male'   => "Gender::MALE",
            'female' => "Gender::FEMALE",
            default  => throw new LogicException(),
        };
    }
}
