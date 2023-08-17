<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Repositories;

use ConorSmith\Pokemon\Location\Domain\Region;
use ConorSmith\Pokemon\RegionConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\RegionalVictoryQuery;

final class RegionRepository
{
    public function __construct(
        private readonly RegionConfigRepository $regionConfigRepository,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
    ) {}

    public function find(RegionId $id): Region
    {
        $regionConfig = $this->regionConfigRepository->find($id);

        if (is_null($regionConfig['unlock'])) {
            $hasVictoryInRequiredRegion = true;
        } else {
            $hasVictoryInRequiredRegion = $this->regionalVictoryQuery->run($regionConfig['unlock']);
        }

        return new Region(
            $id,
            !$hasVictoryInRequiredRegion,
        );
    }
}
