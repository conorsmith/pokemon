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
        public readonly StatsIv $ivs,
        public readonly int $evHp,
        public readonly int $evPhysicalAttack,
        public readonly int $evPhysicalDefence,
        public readonly int $evSpecialAttack,
        public readonly int $evSpecialDefence,
        public readonly int $evSpeed,
    ) {}

    public function calculateHp(): int
    {
        return StatCalculator::calculateHp($this->baseHp, $this->ivs->hp, $this->evHp, $this->level);
    }

    public function calculatePhysicalAttack(): int
    {
        return StatCalculator::calculate($this->basePhysicalAttack, $this->ivs->physicalAttack, $this->evPhysicalAttack, $this->level);
    }

    public function calculatePhysicalDefence(): int
    {
        return StatCalculator::calculate($this->basePhysicalDefence, $this->ivs->physicalDefence, $this->evPhysicalDefence, $this->level);
    }

    public function calculateSpecialAttack(): int
    {
        return StatCalculator::calculate($this->baseSpecialAttack, $this->ivs->specialAttack, $this->evSpecialAttack, $this->level);
    }

    public function calculateSpecialDefence(): int
    {
        return StatCalculator::calculate($this->baseSpecialDefence, $this->ivs->specialDefence, $this->evSpecialDefence, $this->level);
    }

    public function calculateSpeed(): int
    {
        return StatCalculator::calculate($this->baseSpeed, $this->ivs->speed, $this->evSpeed, $this->level);
    }

    public function calculateTotalIvStrength(int $offset): float
    {
        $totalIvs = $this->ivs->physicalAttack
            + $this->ivs->physicalDefence
            + $this->ivs->specialAttack
            + $this->ivs->specialDefence
            + $this->ivs->speed
            + $this->ivs->hp;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 6);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 6);
    }

    public function calculateOffensiveIvStrength(int $offset): float
    {
        $totalIvs = $this->ivs->physicalAttack
            + $this->ivs->specialAttack
            + $this->ivs->speed;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 3);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 3);
    }

    public function calculateDefensiveIvStrength(int $offset): float
    {
        $totalIvs = $this->ivs->physicalDefence
            + $this->ivs->specialDefence
            + $this->ivs->hp;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 3);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 3);
    }

    public function calculateAttackIvStrength(int $offset): float
    {
        $totalIvs = $this->ivs->physicalAttack
            + $this->ivs->specialAttack;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 2);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 2);
    }

    public function calculateDefenceIvStrength(int $offset): float
    {
        $totalIvs = $this->ivs->physicalDefence
            + $this->ivs->specialDefence;

        $totalIvs += $offset;
        $totalIvs = min($totalIvs, 31 * 2);
        $totalIvs = max($totalIvs, 0);

        return $totalIvs / (31 * 2);
    }
}
