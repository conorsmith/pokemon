<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

enum GymBadge: int
{
    case BOULDER = 1;
    case CASCADE = 2;
    case THUNDER = 3;
    case RAINBOW = 4;
    case SOUL = 5;
    case MARSH = 6;
    case VOLCANO = 7;
    case EARTH = 8;

    public function levelLimit(): int
    {
        return match($this) {
            self::BOULDER => 20,
            self::CASCADE => 30,
            self::THUNDER => 30,
            self::RAINBOW => 50,
            self::SOUL => 50,
            self::MARSH => 70,
            self::VOLCANO => 70,
            self::EARTH => 100,
        };
    }

    public static function findHighestRanked(array $gymBadges): self
    {
        $highestRanked = self::BOULDER;

        /** @var GymBadge $gymBadge */
        foreach ($gymBadges as $gymBadge) {
            if ($gymBadge->value > $highestRanked->value) {
                $highestRanked = $gymBadge;
            }
        }

        return $highestRanked;
    }
}
