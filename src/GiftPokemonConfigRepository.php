<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class GiftPokemonConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/Config/GiftPokemon.php";
    }

    public function findInLocation(string $locationId): array
    {
        return array_filter(
            $this->config,
            fn (array $entry) => $entry['location'] === $locationId,
        );
    }
}
