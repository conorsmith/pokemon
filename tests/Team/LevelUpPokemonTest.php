<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team;

use ConorSmith\Pokemon\GymBadge;
use ConorSmith\Pokemon\Team\LevelUpPokemon;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;

final class LevelUpPokemonTest extends TestCase
{
    #[Test]
    #[DataProvider('providerOfUseCases')]
    function is_does_something(int $levelLimit, int $currentLevel, int $newLevel)
    {
        assertThat(
            LevelUpPokemon::calculateNewLevel($currentLevel, $levelLimit),
            identicalTo($newLevel),
        );
    }

    public static function providerOfUseCases(): array
    {
        return [
            [GymBadge::BOULDER->levelLimit(), 0, 0 + 1],

            [GymBadge::CASCADE->levelLimit(), 0, 0 + 1],

            [GymBadge::THUNDER->levelLimit(), 0, 0 + 1],

            [GymBadge::RAINBOW->levelLimit(), 0, 0 + 2],
            [GymBadge::RAINBOW->levelLimit(), 10, 10 + 2],
            [GymBadge::RAINBOW->levelLimit(), 19, 20],
            [GymBadge::RAINBOW->levelLimit(), 20, 20 + 1],

            [GymBadge::SOUL->levelLimit(), 0, 0 + 2],
            [GymBadge::SOUL->levelLimit(), 10, 10 + 2],
            [GymBadge::SOUL->levelLimit(), 19, 20],
            [GymBadge::SOUL->levelLimit(), 20, 20 + 1],

            [GymBadge::MARSH->levelLimit(), 0, 0 + 10],
            [GymBadge::MARSH->levelLimit(), 10, 10 + 10],
            [GymBadge::MARSH->levelLimit(), 15, 20],
            [GymBadge::MARSH->levelLimit(), 20, 20 + 2],
            [GymBadge::MARSH->levelLimit(), 29, 30],
            [GymBadge::MARSH->levelLimit(), 30, 30 + 1],

            [GymBadge::VOLCANO->levelLimit(), 0, 0 + 10],
            [GymBadge::VOLCANO->levelLimit(), 10, 10 + 10],
            [GymBadge::VOLCANO->levelLimit(), 15, 20],
            [GymBadge::VOLCANO->levelLimit(), 20, 20 + 2],
            [GymBadge::VOLCANO->levelLimit(), 29, 30],
            [GymBadge::VOLCANO->levelLimit(), 30, 30 + 1],

            [GymBadge::EARTH->levelLimit(), 0, 20],
            [GymBadge::EARTH->levelLimit(), 10, 20],
            [GymBadge::EARTH->levelLimit(), 20, 20 + 10],
            [GymBadge::EARTH->levelLimit(), 25, 30],
            [GymBadge::EARTH->levelLimit(), 30, 30 + 2],
            [GymBadge::EARTH->levelLimit(), 40, 40 + 2],
            [GymBadge::EARTH->levelLimit(), 49, 50],
            [GymBadge::EARTH->levelLimit(), 50, 50 + 1],

            [GymBadge::ZEPHYR->levelLimit(), 0, 20],
            [GymBadge::ZEPHYR->levelLimit(), 10, 20],
            [GymBadge::ZEPHYR->levelLimit(), 20, 20 + 10],
            [GymBadge::ZEPHYR->levelLimit(), 25, 30],
            [GymBadge::ZEPHYR->levelLimit(), 30, 30 + 2],
            [GymBadge::ZEPHYR->levelLimit(), 40, 40 + 2],
            [GymBadge::ZEPHYR->levelLimit(), 49, 50],
            [GymBadge::ZEPHYR->levelLimit(), 50, 50 + 1],

            [GymBadge::HIVE->levelLimit(), 0, 20],
            [GymBadge::HIVE->levelLimit(), 10, 20],
            [GymBadge::HIVE->levelLimit(), 20, 20 + 10],
            [GymBadge::HIVE->levelLimit(), 25, 30],
            [GymBadge::HIVE->levelLimit(), 30, 30 + 2],
            [GymBadge::HIVE->levelLimit(), 40, 40 + 2],
            [GymBadge::HIVE->levelLimit(), 49, 50],
            [GymBadge::HIVE->levelLimit(), 50, 50 + 1],

            [GymBadge::PLAIN->levelLimit(), 0, 20],
            [GymBadge::PLAIN->levelLimit(), 10, 20],
            [GymBadge::PLAIN->levelLimit(), 20, 20 + 10],
            [GymBadge::PLAIN->levelLimit(), 25, 30],
            [GymBadge::PLAIN->levelLimit(), 30, 30 + 2],
            [GymBadge::PLAIN->levelLimit(), 40, 40 + 2],
            [GymBadge::PLAIN->levelLimit(), 49, 50],
            [GymBadge::PLAIN->levelLimit(), 50, 50 + 1],

            [GymBadge::FOG->levelLimit(), 0, 20],
            [GymBadge::FOG->levelLimit(), 10, 20],
            [GymBadge::FOG->levelLimit(), 20, 30],
            [GymBadge::FOG->levelLimit(), 30, 40],
            [GymBadge::FOG->levelLimit(), 40, 40 + 10],
            [GymBadge::FOG->levelLimit(), 45, 50],
            [GymBadge::FOG->levelLimit(), 50, 50 + 2],
            [GymBadge::FOG->levelLimit(), 60, 60 + 2],
            [GymBadge::FOG->levelLimit(), 69, 70],
            [GymBadge::FOG->levelLimit(), 70, 70 + 1],

            [GymBadge::STORM->levelLimit(), 0, 20],
            [GymBadge::STORM->levelLimit(), 10, 20],
            [GymBadge::STORM->levelLimit(), 20, 30],
            [GymBadge::STORM->levelLimit(), 30, 50],
            [GymBadge::STORM->levelLimit(), 40, 50],
            [GymBadge::STORM->levelLimit(), 50, 50 + 10],
            [GymBadge::STORM->levelLimit(), 60, 60 + 10],
            [GymBadge::STORM->levelLimit(), 65, 70],
            [GymBadge::STORM->levelLimit(), 70, 70 + 2],
            [GymBadge::STORM->levelLimit(), 80, 80 + 2],
            [GymBadge::STORM->levelLimit(), 89, 90],
            [GymBadge::STORM->levelLimit(), 90, 90 + 1],

            [GymBadge::MINERAL->levelLimit(), 0, 20],
            [GymBadge::MINERAL->levelLimit(), 10, 20],
            [GymBadge::MINERAL->levelLimit(), 20, 30],
            [GymBadge::MINERAL->levelLimit(), 30, 50],
            [GymBadge::MINERAL->levelLimit(), 40, 50],
            [GymBadge::MINERAL->levelLimit(), 50, 50 + 10],
            [GymBadge::MINERAL->levelLimit(), 60, 60 + 10],
            [GymBadge::MINERAL->levelLimit(), 65, 70],
            [GymBadge::MINERAL->levelLimit(), 70, 70 + 2],
            [GymBadge::MINERAL->levelLimit(), 80, 80 + 2],
            [GymBadge::MINERAL->levelLimit(), 89, 90],
            [GymBadge::MINERAL->levelLimit(), 90, 90 + 1],

            [GymBadge::GLACIER->levelLimit(), 0, 20],
            [GymBadge::GLACIER->levelLimit(), 10, 20],
            [GymBadge::GLACIER->levelLimit(), 20, 30],
            [GymBadge::GLACIER->levelLimit(), 30, 50],
            [GymBadge::GLACIER->levelLimit(), 40, 50],
            [GymBadge::GLACIER->levelLimit(), 50, 50 + 10],
            [GymBadge::GLACIER->levelLimit(), 60, 60 + 10],
            [GymBadge::GLACIER->levelLimit(), 65, 70],
            [GymBadge::GLACIER->levelLimit(), 70, 70 + 2],
            [GymBadge::GLACIER->levelLimit(), 80, 80 + 2],
            [GymBadge::GLACIER->levelLimit(), 89, 90],
            [GymBadge::GLACIER->levelLimit(), 90, 90 + 1],

            [GymBadge::RISING->levelLimit(), 0, 20],
            [GymBadge::RISING->levelLimit(), 10, 20],
            [GymBadge::RISING->levelLimit(), 20, 30],
            [GymBadge::RISING->levelLimit(), 30, 50],
            [GymBadge::RISING->levelLimit(), 40, 50],
            [GymBadge::RISING->levelLimit(), 50, 70],
            [GymBadge::RISING->levelLimit(), 60, 70],
            [GymBadge::RISING->levelLimit(), 70, 70 + 10],
            [GymBadge::RISING->levelLimit(), 80, 80 + 10],
            [GymBadge::RISING->levelLimit(), 85, 90],
            [GymBadge::RISING->levelLimit(), 90, 90 + 2],
            [GymBadge::RISING->levelLimit(), 99, 100],
            [GymBadge::RISING->levelLimit(), 100, 100 + 1],
        ];
    }
}
