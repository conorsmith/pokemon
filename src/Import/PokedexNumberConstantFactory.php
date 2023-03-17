<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\PokedexNumberConstant;
use Exception;

final class PokedexNumberConstantFactory
{
    public function createPokedexNumberConstantssFromBulbapedia(array $bulbapediaPokedexNumberConstants): array
    {
        $constants = [];

        foreach ($bulbapediaPokedexNumberConstants as $pokedexNumberConstant) {
            $name = strtoupper($pokedexNumberConstant['name']);
            $name = str_replace(" ", "_", $name);
            $name = str_replace("-", "_", $name);
            $name = str_replace("'", "_", $name);
            $name = str_replace("♀", "_F", $name);
            $name = str_replace("♂", "_M", $name);
            $name = str_replace("é", "E", $name);
            $name = str_replace(".", "", $name);
            $name = str_replace(":", "", $name);

            if (preg_match("/^[A-Z0-9_]+$/", $name) === 0) {
                throw new Exception;
            }

            $constants[] = new PokedexNumberConstant(
                $name,
                $pokedexNumberConstant['number']
            );
        }

        return $constants;
    }
}