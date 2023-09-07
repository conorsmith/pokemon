<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\PokemonTest\TestDouble;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use WeakMap;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\equalTo;
use function PHPUnit\Framework\identicalTo;

final class AreaRepositoryTest extends TestCase
{
    #[Test]
    function it_finds_an_area_with_a_single_location()
    {
        $battleRepo = TestDouble::stub(BattleRepository::class);

        $battleRepo->findBattlesInLocation("The Location ID")
            ->willReturn([
                "Battle 1",
                "Battle 2",
            ]);

        $trainerRepo = TestDouble::stub(TrainerRepository::class);

        $trainerRepo->findTrainersInLocation("The Location ID")
            ->willReturn([
                "Trainer 1",
                "Trainer 2",
            ]);

        $locationConfig = new WeakMap();
        $locationConfig[RegionId::KANTO] = [
            [
                'id' => "The Location ID",
            ],
        ];

        $repo = new AreaRepository($battleRepo->reveal(), $trainerRepo->reveal(), new LocationConfigRepository($locationConfig));

        $area = $repo->find("The Location ID");

        assertThat(
            $area,
            equalTo(new Area(
                "The Location ID",
                [
                    "Trainer 1",
                    "Trainer 2",
                ],
                [
                    "Battle 1",
                    "Battle 2",
                ],
            ))
        );
    }

    #[Test]
    function it_finds_an_area_comprised_of_multiple_locations()
    {
        $battleRepo = TestDouble::stub(BattleRepository::class);

        $battleRepo->findBattlesInLocation("Location 1")
            ->willReturn([
                "Battle 1",
                "Battle 2",
            ]);

        $battleRepo->findBattlesInLocation("Location 2")
            ->willReturn([]);

        $battleRepo->findBattlesInLocation("Location 3")
            ->willReturn([
                "Battle 3",
                "Battle 4",
                "Battle 5",
            ]);

        $trainerRepo = TestDouble::stub(TrainerRepository::class);

        $trainerRepo->findTrainersInLocation("Location 1")
            ->willReturn([
                "Trainer 1",
                "Trainer 2",
            ]);

        $trainerRepo->findTrainersInLocation("Location 2")
            ->willReturn([]);

        $trainerRepo->findTrainersInLocation("Location 3")
            ->willReturn([
                "Trainer 3",
                "Trainer 4",
                "Trainer 5",
            ]);

        $locationConfig = new WeakMap();
        $locationConfig[RegionId::KANTO] = [
            [
                'id'   => "Location 1",
                'area' => "The Area ID",
            ],
            [
                'id'   => "Location 2",
                'area' => "The Area ID",
            ],
            [
                'id'   => "Location 3",
                'area' => "The Area ID",
            ],
        ];

        $repo = new AreaRepository($battleRepo->reveal(), $trainerRepo->reveal(), new LocationConfigRepository($locationConfig));

        $area = $repo->find("Location 2");

        assertThat(
            $area,
            equalTo(new Area(
                "The Area ID",
                [
                    "Trainer 1",
                    "Trainer 2",
                    "Trainer 3",
                    "Trainer 4",
                    "Trainer 5",
                ],
                [
                    "Battle 1",
                    "Battle 2",
                    "Battle 3",
                    "Battle 4",
                    "Battle 5",
                ],
            ))
        );
    }

    #[Test]
    function it_cannot_find_an_area()
    {
        $battleRepo = TestDouble::stub(BattleRepository::class);

        $trainerRepo = TestDouble::stub(TrainerRepository::class);

        $repo = new AreaRepository($battleRepo->reveal(), $trainerRepo->reveal(), new LocationConfigRepository(new WeakMap()));

        $area = $repo->find("The Location ID");

        assertThat(
            $area,
            identicalTo(null)
        );
    }
}
