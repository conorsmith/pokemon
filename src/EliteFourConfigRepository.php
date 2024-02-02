<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class EliteFourConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/Config/EliteFour.php";
    }

    public function findInLocation(string $locationId): ?array
    {
        foreach ($this->config as $entry) {
            if ($entry['location'] === $locationId) {
                return $entry;
            }
        }

        return null;
    }

    public function findInRegion(RegionId $regionId): ?array
    {
        foreach ($this->config as $entry) {
            if ($entry['region'] === $regionId) {
                return $entry;
            }
        }

        return null;
    }
}
