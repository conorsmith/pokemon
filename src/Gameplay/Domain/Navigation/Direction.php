<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Navigation;

final class Direction
{
    public const N = "n";
    public const E = "e";
    public const W = "w";
    public const S = "s";

    public const U = "u";
    public const D = "d";

    public const EXIT = "x";

    public static function isCardinal($direction): bool
    {
        return $direction === self::N
            || $direction === self::E
            || $direction === self::W
            || $direction === self::S;
    }

    public static function isVertical($direction): bool
    {
        return $direction === self::U
            || $direction === self::D;
    }

    public static function isExit($direction): bool
    {
        return $direction === self::EXIT;
    }
}
