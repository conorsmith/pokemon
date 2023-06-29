<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Domain;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Gender;
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
        $trainer = self::createUnbeatenTrainer();

        $area = new Area(
            "some area id",
            [],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer($trainer),
            isFalse()
        );
    }

    #[Test]
    function it_confirms_that_the_given_trainer_is_the_only_unbeaten_trainer()
    {
        $trainer = self::createUnbeatenTrainer("given trainer id");

        $area = new Area(
            "some area id",
            [
                self::createUnbeatenTrainer("given trainer id"),
                self::createBeatenTrainer(),
            ],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer($trainer),
            isTrue()
        );
    }

    #[Test]
    function it_rejects_that_the_given_trainer_is_the_only_unbeaten_trainer()
    {
        $trainer = self::createUnbeatenTrainer("given trainer id");

        $area = new Area(
            "some area id",
            [
                self::createUnbeatenTrainer("given trainer id"),
                self::createUnbeatenTrainer(),
            ],
        );

        assertThat(
            $area->isOnlyUnbeatenTrainer($trainer),
            isFalse()
        );
    }

    private static function createUnbeatenTrainer(string $id = "some id"): Trainer
    {
        return new Trainer(
            $id,
            "some name",
            "some class",
            Gender::IMMATERIAL,
            [],
            "some location",
            false,
            null,
            0,
            null,
        );
    }

    private static function createBeatenTrainer(string $id = "some id"): Trainer
    {
        return new Trainer(
            $id,
            "some name",
            "some class",
            Gender::IMMATERIAL,
            [],
            "some location",
            false,
            new CarbonImmutable("2020-02-20 20:00:00"),
            0,
            null,
        );
    }
}
