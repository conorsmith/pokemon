<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\Battle\Domain\Battle;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isFalse;
use function PHPUnit\Framework\isTrue;

final class AreaTest extends TestCase
{
    #[Test]
    function area_with_no_trainers()
    {
        $area = new Area(
            "some area id",
            [],
            [],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer("any trainer id"),
            isFalse()
        );
    }

    #[Test]
    function it_confirms_that_the_given_trainer_is_the_only_unbeaten_trainer()
    {
        $area = new Area(
            "some area id",
            [],
            [
                self::createBattleWithUnbeatenTrainer("given trainer id"),
                self::createBattleWithBeatenTrainer(),
            ],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer("given trainer id"),
            isTrue()
        );
    }

    #[Test]
    function it_rejects_that_the_given_trainer_is_the_only_unbeaten_trainer()
    {
        $area = new Area(
            "some area id",
            [],
            [
                self::createBattleWithUnbeatenTrainer("given trainer id"),
                self::createBattleWithUnbeatenTrainer(),
            ],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer("given trainer id"),
            isFalse()
        );
    }

    private static function createBattleWithUnbeatenTrainer(string $trainerId = "some trainer id"): Battle
    {
        return new Battle(
            "some battle id",
            $trainerId,
            null,
            123,
        );
    }

    private static function createBattleWithBeatenTrainer(string $trainerId = "some trainer id"): Battle
    {
        return new Battle(
            "some battle id",
            $trainerId,
            new CarbonImmutable("2020-02-20 20:00:00"),
            123,
        );
    }
}
