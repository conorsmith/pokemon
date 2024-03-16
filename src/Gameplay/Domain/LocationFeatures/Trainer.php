<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use DateTimeImmutable;

final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly int $partySize,
        public readonly bool $playerCanBattle,
        public readonly ?DateTimeImmutable $lastBeaten,
        public readonly bool $isGymLeader,
    ) {}

    public function playerHasBeaten(): bool
    {
        return !is_null($this->lastBeaten);
    }
}
