<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

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
}
