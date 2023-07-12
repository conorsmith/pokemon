<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEggGroups;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ReflectionClass;

final class EggCyclesConfig
{
    public static function fromPokemonEggCycles(array $eggCycles): string
    {
        $config = "<?php" . PHP_EOL;
        $config .= "declare(strict_types=1);" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "use ConorSmith\Pokemon\PokedexNo;" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "return [" . PHP_EOL;

        /** @var PokemonEggGroups $eggCycle */
        foreach ($eggCycles as $eggCycle) {
            $config .= "    " . self::encodePokedexNumber($eggCycle->pokedexNumber) . " => " . $eggCycle->value . "," . PHP_EOL;
        }

        $config .= "];" . PHP_EOL;

        return $config;
    }

    private static function encodePokedexNumber(PokedexNumber $pokedexNumber): string
    {
        $reflector = new ReflectionClass(PokedexNumberConstants::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$pokedexNumber->value];
    }
}