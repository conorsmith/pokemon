<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

interface ReportBattleWithGymLeaderCommand
{
    public function run(array $pokemonIds): void;
}
