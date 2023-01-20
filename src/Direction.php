<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class Direction
{
    public const N = "n";
    public const E = "e";
    public const W = "w";
    public const S = "s";

    public static function isCardinal($direction): bool
    {
        return $direction === self::N
            || $direction === self::E
            || $direction === self::W
            || $direction === self::S;
    }

    public static function toSlug(string $direction): string
    {
        return match ($direction) {
            self::N => "north",
            self::E => "east",
            self::W => "west",
            self::S => "south",
        };
    }
}
