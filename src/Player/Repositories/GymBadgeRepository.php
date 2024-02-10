<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Player\Repositories;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface GymBadgeRepository
{
    public function findForRegion(RegionId $regionId): array;
}
