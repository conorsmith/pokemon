<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface RegionRepository
{
    public function find(RegionId $id): Region;
}
