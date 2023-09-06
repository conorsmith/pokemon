<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;

interface HighestRankedGymBadgeQuery
{
    public function run(): GymBadge;
}
