<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Navigation;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class Location
{
    public function __construct(
        public readonly string $id,
        public readonly RegionId $region,
        public readonly array $adjacentLocations,
    ) {}
}
