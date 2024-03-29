<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Gameplay\Domain\Breeding\EggGroup;
use ConorSmith\Pokemon\SharedKernel\Domain\AttributeTag;
use Exception;

final class PokedexConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $primaryConfig = require __DIR__ . "/Config/Pokedex.php";

        $attributeTagsConfig = require __DIR__ . "/Config/AttributeTags.php";
        $eggCyclesConfig = require __DIR__ . "/Config/EggCycles.php";
        $eggGroupsConfig = require __DIR__ . "/Config/EggGroups.php";
        $sexRatiosConfig = require __DIR__ . "/Config/SexRatios.php";
        $statsConfig = require __DIR__ . "/Config/Stats.php";

        $fullConfig = [];

        foreach ($primaryConfig as $key => $primaryEntry) {
            $fullConfig[$key] = array_merge(
                $primaryEntry,
                [
                    'attributeTags' => $attributeTagsConfig[$key],
                    'eggCycles'     => $eggCyclesConfig[$key],
                    'eggGroups'     => $eggGroupsConfig[$key],
                    'sexRatio'      => $sexRatiosConfig[$key],
                    'stats'         => $statsConfig[$key],
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
        return array_filter(
            $this->config,
            function (array $config) use ($type) {
                return $config['type'][0] === $type
                    || (isset($config['type'][1]) && $config['type'][1] === $type);
            },
        );
    }

    public function findAllWithAttributeTag(AttributeTag $attributeTag): array
    {
        return array_filter(
            $this->config,
            function (array $config) use ($attributeTag) {
                return in_array($attributeTag, $config['attributeTags']);
            },
        );
    }

    public function findAllInEggGroup(EggGroup $eggGroup): array
    {
        return array_filter(
            $this->config,
            function (array $config) use ($eggGroup) {
                return in_array($eggGroup, $config['eggGroups']);
            },
        );
    }

    public function find(string $pokedexNumber): array
    {
        if (!array_key_exists($pokedexNumber, $this->config)) {
            throw new Exception("Could not find Pokémon with ID '{$pokedexNumber}'");
        }

        return $this->config[$pokedexNumber];
    }
}
