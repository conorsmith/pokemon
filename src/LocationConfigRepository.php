<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use WeakMap;

final class LocationConfigRepository
{
    private WeakMap $locationConfigByRegion;

    public function __construct()
    {
        $this->locationConfigByRegion = new WeakMap();
        $this->locationConfigByRegion[Region::KANTO] = require __DIR__ . "/Config/Locations/Kanto.php";
    }

    public function findLocation(string $locationId): ?array
    {
        foreach ($this->locationConfigByRegion as $region => $config) {
            foreach ($config as $entry) {
                if ($entry['id'] === $locationId) {
                    return $entry;
                }
            }
        }

        return null;
    }

    public function findLocationsInArea(string $areaId): array
    {
        $locations = [];

        foreach ($this->locationConfigByRegion as $region => $config) {
            foreach ($config as $entry) {
                if (isset($entry['area']) && $entry['area'] === $areaId) {
                    $locations[] = $entry;
                }
            }
        }

        return $locations;
    }
}
