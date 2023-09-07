<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface RegionalVictoryQuery
{
    public function run(RegionId $region): bool;
}
