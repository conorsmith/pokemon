<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

final class EncounterType
{
    public const ALL = [
        self::WALKING,
        self::SURFING,
        self::FISHING,
        self::ROCK_SMASH,
    ];

    public const WALKING = "walking";
    public const SURFING = "surfing";
    public const FISHING = "fishing";
    public const ROCK_SMASH = "rockSmash";
}
