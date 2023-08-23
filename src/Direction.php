<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use LogicException;

final class Direction
{
    public const N = "n";
    public const E = "e";
    public const W = "w";
    public const S = "s";

    public const U = "u";
    public const D = "d";

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
    public static function toSlug(string $direction): string
    {
        return match ($direction) {
            self::N => "north",
            self::E => "east",
            self::W => "west",
            self::S => "south",
            self::U => "up",
            self::D => "down",
            default => throw new LogicException(),
        };
    }
}
