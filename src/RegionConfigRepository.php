<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use Exception;

final class RegionConfigRepository
{
    private readonly array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/Config/Regions.php";
    }

    public function find(RegionId $id): array
    {
        foreach ($this->config as $config) {
            if ($config['id'] === $id) {
                return $config;
            }
        }

        throw new Exception("Unknown Region ID");
    }
}