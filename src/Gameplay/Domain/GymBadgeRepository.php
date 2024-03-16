<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface GymBadgeRepository
{
    public function all(): array;

    public function findForRegion(RegionId $regionId): array;

    public function findHighestRanked(): GymBadge;
}
