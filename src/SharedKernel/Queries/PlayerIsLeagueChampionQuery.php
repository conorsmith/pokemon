<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface PlayerIsLeagueChampionQuery
{
    public function run(RegionId $regionId): bool;
}
