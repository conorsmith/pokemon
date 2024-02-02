<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

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
}
