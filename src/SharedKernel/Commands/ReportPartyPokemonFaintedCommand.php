<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

interface ReportPartyPokemonFaintedCommand
{
    public function run(
        string $partyPokemonId,
        int    $partyPokemonLevel,
        int    $opponentPokemonLevel,
    ): void;
}
