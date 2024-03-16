<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

interface LeagueChampionRepository
{
    public function find(RegionId $regionId): LeagueChampion;

    public function save(LeagueChampion $leagueChampion): void;
}
