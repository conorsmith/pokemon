<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

final class AttackOutcome
{
    public function __construct(
        public readonly bool $hit,
        public readonly bool $criticalHit,
        public readonly bool $superEffective,
        public readonly bool $notVeryEffective,
        public readonly bool $enduredHit,
        public readonly int $damageDealt,
    ) {}
}
