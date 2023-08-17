<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEvYield;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ReflectionClass;

final class EvYieldsConfig
{
    public static function fromPokemonEvYields(array $evYields): string
    {
        $config = "<?php" . PHP_EOL;
        $config .= "declare(strict_types=1);" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "use ConorSmith\Pokemon\PokedexNo;" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "return [" . PHP_EOL;

        /** @var PokemonEvYield $evYield */
        foreach ($evYields as $evYield) {
            $config .= "    [" . PHP_EOL;
            $config .= "        'pokedexNumber' => " . self::encodePokedexNumber($evYield->pokedexNumber) . "," . PHP_EOL;
            if (!is_null($evYield->form)) {
                $config .= "        'form' => \"{$evYield->form}\"," . PHP_EOL;
            }
            if (!is_null($evYield->exp)) {
                $config .= "        'exp' => {$evYield->exp}," . PHP_EOL;
            }
            $config .= "        'hp' => {$evYield->hp}," . PHP_EOL;
            $config .= "        'physicalAttack' => {$evYield->physicalAttack}," . PHP_EOL;
            $config .= "        'physicalDefence' => {$evYield->physicalDefence}," . PHP_EOL;
            $config .= "        'specialAttack' => {$evYield->specialAttack}," . PHP_EOL;
            $config .= "        'specialDefence' => {$evYield->specialDefence}," . PHP_EOL;
            $config .= "        'speed' => {$evYield->speed}," . PHP_EOL;
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
