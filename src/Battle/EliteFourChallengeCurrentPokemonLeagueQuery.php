<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\SharedKernel\CurrentPokemonLeagueQuery;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

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
