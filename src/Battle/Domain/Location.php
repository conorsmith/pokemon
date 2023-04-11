<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;

final class Location
{
    public function __construct(
        public readonly string $id,
        private readonly Region $region,
    ) {}

    public function calculateRegionalLevelOffset(): int
    {
        return match($this->region) {
            Region::KANTO => 0,
            Region::JOHTO => 50,
        };
    }
}
