<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
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
        $trainerRepo = self::createStub(TrainerRepository::class);

        $trainerRepo->method("findTrainersInLocation")
            ->with("The Location ID")
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

        $repo = new AreaRepository($trainerRepo, new LocationConfigRepository($locationConfig));

        $area = $repo->find("The Location ID");

        assertThat(
            $area,
            equalTo(new Area(
                "The Location ID",
                [
                    "Trainer 1",
                    "Trainer 2",
                ],
            ))
        );
    }

    #[Test]
    function it_finds_an_area_comprised_of_multiple_locations()
    {
        $trainerRepo = self::createStub(TrainerRepository::class);

        $trainerRepo->method("findTrainersInLocation")
            ->will(self::returnValueMap([
                [
                    "Location 1",
                    [
                        "Trainer 1",
                        "Trainer 2",
                    ],
                ],
                [
                    "Location 2",
                    [],
                ],
                [
                    "Location 3",
                    [
                        "Trainer 3",
                        "Trainer 4",
                        "Trainer 5",
                    ],
                ],
            ]));

        $locationConfig = new WeakMap();
        $locationConfig[RegionId::KANTO] = [
            [
                'id' => "Location 1",
                'area' => "The Area ID",
            ],
            [
                'id' => "Location 2",
                'area' => "The Area ID",
            ],
            [
                'id' => "Location 3",
                'area' => "The Area ID",
            ],
        ];

        $repo = new AreaRepository($trainerRepo, new LocationConfigRepository($locationConfig));

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
            ))
        );
    }

    #[Test]
    function it_cannot_find_an_area()
    {
        $trainerRepo = self::createStub(TrainerRepository::class);

        $repo = new AreaRepository($trainerRepo, new LocationConfigRepository(new WeakMap()));

        $area = $repo->find("The Location ID");

        assertThat(
            $area,
            identicalTo(null)
        );
    }
}
