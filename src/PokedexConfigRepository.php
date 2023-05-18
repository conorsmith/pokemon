<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class PokedexConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/Config/Pokedex.php";
    }

    public function find(string $pokedexNumber): array
    {
        return $this->config[$pokedexNumber];
    }
}
