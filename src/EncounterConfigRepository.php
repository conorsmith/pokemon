<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use WeakMap;

final class EncounterConfigRepository
{
    private WeakMap $encounterConfigRepository;

    public function __construct()
    {
        $this->encounterConfigRepository = new WeakMap();
        $this->encounterConfigRepository[Region::KANTO] = require __DIR__ . "/Config/Encounters/Kanto.php";
        $this->encounterConfigRepository[Region::JOHTO] = require __DIR__ . "/Config/Encounters/Johto.php";
        $this->encounterConfigRepository[Region::HOENN] = require __DIR__ . "/Config/Encounters/Hoenn.php";
    }

    public function allByRegion(): WeakMap
    {
        return $this->encounterConfigRepository;
    }

    public function findEncounters(string $locationId): ?array
    {
        foreach ($this->encounterConfigRepository as $region => $config) {
            if (array_key_exists($locationId, $config)) {
                return $config[$locationId];
            }
        }

        return null;
    }
}
