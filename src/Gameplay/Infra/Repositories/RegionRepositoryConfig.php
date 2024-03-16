<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\Region;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\RegionRepository;
use ConorSmith\Pokemon\RegionConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class RegionRepositoryConfig implements RegionRepository
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly RegionConfigRepository $regionConfigRepository,
    ) {}

    public function find(RegionId $id): Region
    {
        $regionConfig = $this->regionConfigRepository->find($id);

        if (is_null($regionConfig['unlock'])) {
            $hasVictoryInRequiredRegion = true;
        } else {
            $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($regionConfig['unlock']);
            $hasVictoryInRequiredRegion = !is_null($eliteFourChallenge);
        }

        return new Region(
            $id,
            !$hasVictoryInRequiredRegion,
        );
    }
}
