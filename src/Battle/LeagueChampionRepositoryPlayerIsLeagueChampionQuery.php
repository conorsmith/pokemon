<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\PlayerIsLeagueChampionQuery;

final class LeagueChampionRepositoryPlayerIsLeagueChampionQuery implements PlayerIsLeagueChampionQuery
{
    public function __construct(
        private readonly LeagueChampionRepository $leagueChampionRepository,
    ) {}

    public function run(RegionId $regionId): bool
    {
        $leagueChampion = $this->leagueChampionRepository->find($regionId);

        return $leagueChampion->isPlayer();
    }
}
