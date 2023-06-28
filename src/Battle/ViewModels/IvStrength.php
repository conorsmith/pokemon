<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ViewModels;

final class IvStrength
{
    public function __construct(
        public readonly float $total,
        public readonly float $offensiveTotal,
        public readonly float $defensiveTotal,
        public readonly float $attackTotal,
        public readonly float $defenceTotal,
        public readonly float $physicalAttack,
        public readonly float $physicalDefence,
        public readonly float $specialAttack,
        public readonly float $specialDefence,
        public readonly float $speed,
        public readonly float $hp,
    ) {}
}
