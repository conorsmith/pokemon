<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Queries\CurrentPokemonLeagueQuery;

final class EliteFourChallengeCurrentPokemonLeagueQuery implements CurrentPokemonLeagueQuery
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
    ) {}

    public function run(): RegionId
    {
        return $this->eliteFourChallengeRepository->findCurrentPokemonLeagueRegionForPlayer();
    }
}
