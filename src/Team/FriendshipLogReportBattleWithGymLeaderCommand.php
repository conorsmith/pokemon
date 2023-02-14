<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;

final class FriendshipLogReportBattleWithGymLeaderCommand implements ReportBattleWithGymLeaderCommand
{
    public function __construct(
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function run(array $pokemonIds): void
    {
        foreach ($pokemonIds as $pokemonId) {
            $this->friendshipLog->battleWithGymLeader($pokemonId);
        }
    }
}
