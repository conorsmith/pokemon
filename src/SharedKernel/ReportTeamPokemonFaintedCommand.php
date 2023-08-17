<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface ReportTeamPokemonFaintedCommand
{
    public function run(
        string $teamPokemonId,
        int    $teamPokemonLevel,
        int    $opponentPokemonLevel,
    ): void;
}
