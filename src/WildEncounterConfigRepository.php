<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use WeakMap;

final class WildEncounterConfigRepository
{
    private WeakMap $config;

    public function __construct()
    {
        $this->config = new WeakMap();
        $this->config[RegionId::KANTO] = require __DIR__ . "/Config/Encounters/Kanto.php";
        $this->config[RegionId::JOHTO] = require __DIR__ . "/Config/Encounters/Johto.php";
        $this->config[RegionId::HOENN] = require __DIR__ . "/Config/Encounters/Hoenn.php";
    }

    public function allByRegion(): WeakMap
    {
        return $this->config;
    }

    public function findWildEncounters(string $locationId): ?array
    {
        foreach ($this->config as $region => $config) {
            if (array_key_exists($locationId, $config)) {
                return $config[$locationId];
            }
        }

        return null;
    }
}
