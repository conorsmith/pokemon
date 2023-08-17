<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;

final class FriendshipLogReportTeamPokemonFaintedCommand implements ReportTeamPokemonFaintedCommand
{
    public function __construct(
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function run(
        string $teamPokemonId,
        int    $teamPokemonLevel,
        int    $opponentPokemonLevel,
    ): void {
        if ($opponentPokemonLevel - $teamPokemonLevel >= 30) {
            $this->friendshipLog->faintedToPowerfulOpponent($teamPokemonId);
        } else {
            $this->friendshipLog->fainted($teamPokemonId);
        }
    }
}
