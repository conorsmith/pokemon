<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

interface PlayerRepository
{
    public function findPlayer(): Player;
    public function savePlayer(Player $player): void;
}
