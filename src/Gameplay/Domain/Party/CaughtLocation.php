<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class CaughtLocation
{
    public function __construct(
        public readonly string $locationId,
        public readonly RegionId $region,
    ) {}
}
