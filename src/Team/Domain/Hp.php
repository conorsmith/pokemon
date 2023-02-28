<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Hp
{
    public function __construct(
        public readonly int $baseValue,
        public readonly int $iv = 0,
        public readonly int $ev = 0,
    ) {}

    public function calculate(int $level): int
    {
        $principalHp = (2 * $this->baseValue) + $this->iv + floor($this->ev / 4);

        $physicalHp = floor($principalHp * $level / 100);

        $effectiveHp = $physicalHp + $level + 10;

        return intval($effectiveHp);
    }
}
