<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonSexRatio;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ReflectionClass;

final class SexRatiosConfig
{
    public static function fromPokemonSexRatios(array $sexRatios): string
    {
        $config = "<?php" . PHP_EOL;
        $config .= "declare(strict_types=1);" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "use ConorSmith\Pokemon\PokedexNo;" . PHP_EOL;
        $config .= "use ConorSmith\Pokemon\Sex;" . PHP_EOL;
        $config .= PHP_EOL;
        $config .= "return [" . PHP_EOL;

        /** @var PokemonSexRatio $sexRatio */
        foreach ($sexRatios as $sexRatio) {
            $config .= "    " . self::encodePokedexNumber($sexRatio->pokedexNumber) . " => [" . PHP_EOL;

            if ($sexRatio->femaleWeight > 0) {
                $config .= "        [" . PHP_EOL;
                $config .= "            'sex'    => Sex::FEMALE," . PHP_EOL;
                $config .= "            'weight' => {$sexRatio->femaleWeight}," . PHP_EOL;
                $config .= "        ]," . PHP_EOL;
            }

            if ($sexRatio->maleWeight > 0) {
                $config .= "        [" . PHP_EOL;
                $config .= "            'sex'    => Sex::MALE," . PHP_EOL;
                $config .= "            'weight' => {$sexRatio->maleWeight}," . PHP_EOL;
                $config .= "        ]," . PHP_EOL;
            }

            if ($sexRatio->unknownWeight > 0) {
                $config .= "        [" . PHP_EOL;
                $config .= "            'sex'    => Sex::UNKNOWN," . PHP_EOL;
                $config .= "            'weight' => {$sexRatio->unknownWeight}," . PHP_EOL;
                $config .= "        ]," . PHP_EOL;
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
