<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use ConorSmith\Pokemon\Team\Domain\Type;

final class PokemonConfigRepository
{
    public function find(string $pokedexNumber): ?array
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        if (!array_key_exists($pokedexNumber, $config)) {
            return null;
        }

        return $config[$pokedexNumber];
    }

    public function findType(string $number): ?Type
    {
        $config = require __DIR__ . "/../../Config/Pokedex.php";

        if (!array_key_exists($number, $config)) {
            return null;
        }

        $typeConfig = $config[$number]['type'];

        return new Type(
            $typeConfig[0],
            $typeConfig[1] ?? null,
        );
    }
}
