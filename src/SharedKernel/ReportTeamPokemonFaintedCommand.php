<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface ReportTeamPokemonFaintedCommand
{
    public function run(
        string $teamPokemondId,
        int $teamPokemonLevel,
        int $opponentPokemonLevel,
    ): void;
}
