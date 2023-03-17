<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumberConstant;

final class PokedexNoConstants
{
    public static function fromPokedexNumberConstants(array $constants): string
    {
        $code = "";

        /** @var PokedexNumberConstant $constant */
        foreach ($constants as $constant) {
            $code .= "public const {$constant->name} = \"{$constant->value}\";" . PHP_EOL;
        }

        return $code;
    }
}