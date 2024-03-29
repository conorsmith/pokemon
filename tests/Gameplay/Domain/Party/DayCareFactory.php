<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Domain\Party;

use ConorSmith\Pokemon\Gameplay\Domain\Party\DayCare;

final class DayCareFactory
{
    public static function any(): DayCare
    {
        return new DayCare([], 0);
    }

    public static function notFull(): DayCare
    {
        return new DayCare([], 1);
    }

    public static function full(): DayCare
    {
        return new DayCare([], 0);
    }

    public static function withAttendees(array $attendees): DayCare
    {
        return new DayCare(
            $attendees,
            count($attendees),
        );
    }
}
