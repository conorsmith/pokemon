<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

final class StatCalculator
{
    public static function calculate(int $baseValue, int $iv, int $ev, int $level): int
    {
        $nature = 1;

        $value = (2 * $baseValue) + $iv + floor($ev / 4);

        $value = floor($value * $level / 100) + 5;

        $value = floor($value * $nature);

        return intval($value);
    }

    public static function calculateHp(int $baseValue, int $iv, int $ev, int $level): int
    {
        $hp = (2 * $baseValue) + $iv + floor($ev / 4);

        $hp = floor($hp * $level / 100);

        $hp = $hp + $level + 10;

        return intval($hp);
    }
}
