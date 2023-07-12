<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEggGroups;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ReflectionClass;

final class EggGroupsConfig
{
    public static function fromPokemonEggGroups(array $eggGroups): string
    {
        $config = "<?php" . PHP_EOL;
        $config .= "declare(strict_types=1);" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "use ConorSmith\Pokemon\PokedexNo;" . PHP_EOL;
        $config .= "use ConorSmith\Pokemon\EggGroup;" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "return [" . PHP_EOL;

        /** @var PokemonEggGroups $eggGroup */
        foreach ($eggGroups as $eggGroup) {
            $config .= "    " . self::encodePokedexNumber($eggGroup->pokedexNumber) . " => [" . PHP_EOL;
            $config .= "        EggGroup::" . $eggGroup->firstEggGroup->value . "," . PHP_EOL;
            if (!is_null($eggGroup->secondEggGroup)) {
                $config .= "        EggGroup::" . $eggGroup->secondEggGroup->value . "," . PHP_EOL;
            }
            $config .= "    ]," . PHP_EOL;
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