<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\StatCalculator;

final class Stat
{
    public function __construct(
        public readonly int $baseValue,
        public readonly int $iv = 0,
        public readonly int $ev = 0,
    ) {}

    public function calculate(int $level): int
    {
        return StatCalculator::calculate($this->baseValue, $this->iv, $this->ev, $level);
    }
}
