<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class PokedexConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $primaryConfig = require __DIR__ . "/Config/Pokedex.php";
        $sexRatiosConfig = require __DIR__ . "/Config/SexRatios.php";
        $eggGroupsConfig = require __DIR__ . "/Config/EggGroups.php";
        $eggCyclesConfig = require __DIR__ . "/Config/EggCycles.php";

        $fullConfig = [];

        foreach ($primaryConfig as $key => $primaryEentry) {
            $fullConfig[$key] = array_merge(
                $primaryEentry,
                [
                    'sexRatio' => $sexRatiosConfig[$key],
                    'eggGroups' => $eggGroupsConfig[$key],
                    'eggCycles' => $eggCyclesConfig[$key],
                ],
            );
        }

        $this->config = $fullConfig;
    }

    public function all(): array
    {
        return $this->config;
    }

    public function find(string $pokedexNumber): array
    {
        return $this->config[$pokedexNumber];
    }
}
