<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

final class StatsIv
{
    public function __construct(
        public readonly int $hp,
        public readonly int $physicalAttack,
        public readonly int $physicalDefence,
        public readonly int $specialAttack,
        public readonly int $specialDefence,
        public readonly int $speed,
    ) {}
}
