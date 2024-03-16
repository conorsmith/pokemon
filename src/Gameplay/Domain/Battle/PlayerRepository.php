<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

interface PlayerRepository
{
    public function findPlayer(): Player;
    public function savePlayer(Player $player): void;
}
