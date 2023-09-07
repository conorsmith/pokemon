<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\SharedKernel\Commands\ReportPartyPokemonFaintedCommand;

final class FriendshipLogReportPartyPokemonFaintedCommand implements ReportPartyPokemonFaintedCommand
{
    public function __construct(
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function run(
        string $partyPokemonId,
        int    $partyPokemonLevel,
        int    $opponentPokemonLevel,
    ): void {
        if ($opponentPokemonLevel - $partyPokemonLevel >= 30) {
            $this->friendshipLog->faintedToPowerfulOpponent($partyPokemonId);
        } else {
            $this->friendshipLog->fainted($partyPokemonId);
        }
    }
}
