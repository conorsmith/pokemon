<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;

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

        foreach ($primaryConfig as $key => $primaryEntry) {
            $fullConfig[$key] = array_merge(
                $primaryEntry,
                [
                    'sexRatio'  => $sexRatiosConfig[$key],
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

    public function findAllWithType(int $type): array
    {
        return array_map(
            function (array $config) use ($type) {
                return $config['type'][0] === $type
                    || $config['type'][1] === $type;
            },
            $this->config,
        );
    }

    public function find(string $pokedexNumber): array
    {
        return $this->config[$pokedexNumber];
    }
}
