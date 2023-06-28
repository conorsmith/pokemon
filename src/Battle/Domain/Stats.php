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
        public readonly int $evHp,
        public readonly int $evPhysicalAttack,
        public readonly int $evPhysicalDefence,
        public readonly int $evSpecialAttack,
        public readonly int $evSpecialDefence,
        public readonly int $evSpeed,
    ) {}

    public function calculateHp(): int
    {
        return StatCalculator::calculateHp($this->baseHp, $this->ivHp, $this->evHp, $this->level);
    }

    public function calculatePhysicalAttack(): int
    {
        return StatCalculator::calculate($this->basePhysicalAttack, $this->ivPhysicalAttack, $this->evPhysicalAttack, $this->level);
    }

    public function calculatePhysicalDefence(): int
    {
        return StatCalculator::calculate($this->basePhysicalDefence, $this->ivPhysicalDefence, $this->evPhysicalDefence, $this->level);
    }

    public function calculateSpecialAttack(): int
    {
        return StatCalculator::calculate($this->baseSpecialAttack, $this->ivSpecialAttack, $this->evSpecialAttack, $this->level);
    }

    public function calculateSpecialDefence(): int
    {
        return StatCalculator::calculate($this->baseSpecialDefence, $this->ivSpecialDefence, $this->evSpecialDefence, $this->level);
    }

    public function calculateSpeed(): int
    {
        return StatCalculator::calculate($this->baseSpeed, $this->ivSpeed, $this->evSpeed, $this->level);
    }

    public function calculateTotalStrength(int $offset): float
    {
        $totalIvs = $this->ivPhysicalAttack
            + $this->ivPhysicalDefence
            + $this->ivSpecialAttack
            + $this->ivSpecialDefence
            + $this->ivSpeed
            + $this->ivHp;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 6);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 6);
    }

    public function calculateOffensiveStrength(int $offset): float
    {
        $totalIvs = $this->ivPhysicalAttack
            + $this->ivSpecialAttack
            + $this->ivSpeed;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 3);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 3);
    }

    public function calculateDefensiveStrength(int $offset): float
    {
        $totalIvs = $this->ivPhysicalDefence
            + $this->ivSpecialDefence
            + $this->ivHp;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 3);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 3);
    }

    public function calculateAttackStrength(int $offset): float
    {
        $totalIvs = $this->ivPhysicalAttack
            + $this->ivSpecialAttack;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 2);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 2);
    }

    public function calculateDefenceStrength(int $offset): float
    {
        $totalIvs = $this->ivPhysicalDefence
            + $this->ivSpecialDefence;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 2);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 2);
    }
}
