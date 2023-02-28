<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Stat
{
    public function __construct(
        public readonly int $baseValue,
        public readonly int $iv = 0,
        public readonly int $ev = 0,
    ) {}

    public function calculate(int $level): int
    {
        $nature = 1;

        $principalValue = (2 * $this->baseValue) + $this->iv + floor($this->ev / 4);

        $physicalValue = floor($principalValue * $level / 100) + 5;

        $effectiveValue = floor($physicalValue * $nature);

        return intval($effectiveValue);
    }
}
