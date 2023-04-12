<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\StatCalculator;

final class Stats
{
    public function __construct(
        private readonly int $level,
        private readonly int $baseHp,
        private readonly int $basePhysicalAttack,
        private readonly int $basePhysicalDefence,
        private readonly int $baseSpecialAttack,
        private readonly int $baseSpecialDefence,
        private readonly int $baseSpeed,
        public readonly int $ivHp,
        public readonly int $ivPhysicalAttack,
        public readonly int $ivPhysicalDefence,
        public readonly int $ivSpecialAttack,
        public readonly int $ivSpecialDefence,
        public readonly int $ivSpeed,
    ) {}

    public function calculateHp(): int
    {
        return StatCalculator::calculateHp($this->baseHp, $this->ivHp, 0, $this->level);
    }

    public function calculatePhysicalAttack(): int
    {
        return StatCalculator::calculate($this->basePhysicalAttack, $this->ivPhysicalAttack, 0, $this->level);
    }

    public function calculatePhysicalDefence(): int
    {
        return StatCalculator::calculate($this->basePhysicalDefence, $this->ivPhysicalDefence, 0, $this->level);;
    }

    public function calculateSpecialAttack(): int
    {
        return StatCalculator::calculate($this->baseSpecialAttack, $this->ivSpecialAttack, 0, $this->level);
    }

    public function calculateSpecialDefence(): int
    {
        return StatCalculator::calculate($this->baseSpecialDefence, $this->ivSpecialDefence, 0, $this->level);
    }

    public function calculateSpeed(): int
    {
        return StatCalculator::calculate($this->baseSpeed, $this->ivSpeed, 0, $this->level);
    }
}
