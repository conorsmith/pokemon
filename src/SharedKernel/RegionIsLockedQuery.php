<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface RegionIsLockedQuery
{
    public function run(RegionId $regionId): bool;
}
