<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Region;
use ConorSmith\Pokemon\SharedKernel\RegionalVictoryQuery;

final class EliteFourChallengeRegionalVictoryQuery implements RegionalVictoryQuery
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
    ) {}

    public function run(Region $region): bool
    {
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($region);

        return !is_null($eliteFourChallenge);
    }
}
