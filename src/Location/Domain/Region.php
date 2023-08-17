<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class Region
{
    public function __construct(
        public readonly RegionId $id,
        public readonly bool $isLocked,
    ) {}
}
