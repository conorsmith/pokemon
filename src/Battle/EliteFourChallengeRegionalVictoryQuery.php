<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Queries\RegionalVictoryQuery;

final class EliteFourChallengeRegionalVictoryQuery implements RegionalVictoryQuery
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
    ) {}

    public function run(RegionId $region): bool
    {
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($region);

        return !is_null($eliteFourChallenge);
    }
}
