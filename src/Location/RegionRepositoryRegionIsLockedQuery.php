<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location;

use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\RegionIsLockedQuery;

final class RegionRepositoryRegionIsLockedQuery implements RegionIsLockedQuery
{
    public function __construct(
        private readonly RegionRepository $regionRepository,
    ) {}

    public function run(RegionId $regionId): bool
    {
        $region = $this->regionRepository->find($regionId);

        return $region->isLocked;
    }
}
