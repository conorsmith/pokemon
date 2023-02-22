<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Stats
{
    public function __construct(
        public readonly int $baseHp,
        public readonly int $baseAttack,
        public readonly int $baseDefence,
        public readonly int $baseSpecialAttack,
        public readonly int $baseSpecialDefence,
        public readonly int $baseSpeed,
    ) {}
}
