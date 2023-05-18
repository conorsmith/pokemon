<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;

enum GymBadge: int
{
    // KANTO
    case BOULDER = 1;
    case CASCADE = 2;
    case THUNDER = 3;
    case RAINBOW = 4;
    case SOUL = 5;
    case MARSH = 6;
    case VOLCANO = 7;
    case EARTH = 8;

    // JOHTO
    case ZEPHYR = 9;
    case HIVE = 10;
    case PLAIN = 11;
    case FOG = 12;
    case STORM = 13;
    case MINERAL = 14;
    case GLACIER = 15;
    case RISING = 16;

    // HOENN
    case STONE = 17;
    case KNUCKLE = 18;
    case DYNAMO = 19;
    case HEAT = 20;
    case BALANCE = 21;
    case FEATHER = 22;
    case MIND = 23;
    case RAIN = 24;

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
            self::EARTH => 90,
            self::ZEPHYR => 90,
            self::HIVE => 90,
            self::PLAIN => 90,
            self::FOG => 100,
            self::STORM => 120,
            self::MINERAL => 120,
            self::GLACIER => 120,
            self::RISING => 140,
            self::STONE => 140,
            self::KNUCKLE => 140,
            self::DYNAMO => 140,
            self::HEAT => 150,
            self::BALANCE => 160,
            self::FEATHER => 170,
            self::MIND => 180,
            self::RAIN => 200,
        };
    }

    public static function all(): array
    {
        return [
            self::BOULDER,
            self::CASCADE,
            self::THUNDER,
            self::RAINBOW,
            self::SOUL,
            self::MARSH,
            self::VOLCANO,
            self::EARTH,
            self::ZEPHYR,
            self::HIVE,
            self::PLAIN,
            self::FOG,
            self::STORM,
            self::MINERAL,
            self::GLACIER,
            self::RISING,
            self::STONE,
            self::KNUCKLE,
            self::DYNAMO,
            self::HEAT,
            self::BALANCE,
            self::FEATHER,
            self::MIND,
            self::RAIN,
        ];
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

    public static function allFromRegion(Region $region): array
    {
        return match($region) {
            Region::KANTO => [
                self::BOULDER,
                self::CASCADE,
                self::THUNDER,
                self::RAINBOW,
                self::SOUL,
                self::MARSH,
                self::VOLCANO,
                self::EARTH,
            ],
            Region::JOHTO => [
                self::ZEPHYR,
                self::HIVE,
                self::PLAIN,
                self::FOG,
                self::STORM,
                self::MINERAL,
                self::GLACIER,
                self::RISING,
            ],
            Region::HOENN => [
                self::STONE,
                self::KNUCKLE,
                self::DYNAMO,
                self::HEAT,
                self::BALANCE,
                self::FEATHER,
                self::MIND,
                self::RAIN,
            ],
        };
    }
}
