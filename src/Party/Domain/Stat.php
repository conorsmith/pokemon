<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\StatCalculator;

final class Stat
{
    public function __construct(
        public readonly int $baseValue,
        public readonly int $iv,
        public readonly int $ev,
    ) {}

    public function calculate(int $level): int
    {
        return StatCalculator::calculate($this->baseValue, $this->iv, $this->ev, $level);
    }

    public function boostEv(int $increment): self
    {
        return new self(
            $this->baseValue,
            $this->iv,
            $this->ev + $increment,
        );
    }
}
