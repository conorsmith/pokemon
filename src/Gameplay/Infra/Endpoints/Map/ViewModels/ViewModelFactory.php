<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\Navigation\AdjacentLocation;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Direction;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\Features;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationType;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use LogicException;
use stdClass;

final class ViewModelFactory
{
    public function __construct(
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function createLocation(Location $location,): LocationViewModel
    {
        $locationConfig = $this->locationConfigRepository->findLocation($location->id);

        $cardinalDirections = [
            Direction::N => null,
            Direction::S => null,
            Direction::E => null,
            Direction::W => null,
        ];
        $hasCardinalDirections = false;

        $verticalDirections = [
            Direction::U => null,
            Direction::D => null,
        ];
        $hasVerticalDirections = false;

        $exitDirections = [];
        $hasExitDirections = false;

        $otherDirections = [];

        /** @var AdjacentLocation $adjacentLocation */
        foreach ($location->adjacentLocations as $adjacentLocation) {
            $adjacentLocationViewModel = $this->createAdjacentLocationViewModel($adjacentLocation, $locationConfig);

            if ($adjacentLocation->isInACardinalDirection()) {
                $hasCardinalDirections = true;
                $cardinalDirections[$adjacentLocation->direction] = $adjacentLocationViewModel;

            } elseif ($adjacentLocation->isInAVerticalDirection()) {
                $hasVerticalDirections = true;
                $verticalDirections[$adjacentLocation->direction] = $adjacentLocationViewModel;

            } elseif ($adjacentLocation->isAnExit()) {
                $hasExitDirections = true;
                $exitDirections[] = $adjacentLocationViewModel;

            } else {
                $otherDirections[] = $adjacentLocationViewModel;
            }
        }

        return new LocationViewModel(
            $location->id,
            $locationConfig['name'],
            match ($locationConfig['region']) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
                default         => throw new LogicException(),
            },
            $locationConfig['section'] ?? null,
            $hasCardinalDirections,
            $hasVerticalDirections,
            $hasExitDirections,
            $cardinalDirections[Direction::N],
            $cardinalDirections[Direction::S],
            $cardinalDirections[Direction::E],
            $cardinalDirections[Direction::W],
            $verticalDirections[Direction::U],
            $verticalDirections[Direction::D],
            $exitDirections,
            $otherDirections,
        );
    }

    public function createLocationName(Location $location): stdClass
    {
        $locationConfig = $this->locationConfigRepository->findLocation($location->id);

        return (object) [
            'name'   => $locationConfig['name'],
            'region' => match ($locationConfig['region']) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
                default         => throw new LogicException(),
            },
            'section' => $locationConfig['section'] ?? null,
        ];
    }

    public function createAdjacentLocationViewModel(
        AdjacentLocation $adjacentLocation,
        array $locationConfig
    ): AdjacentLocationViewModel {
        $adjacentLocationConfig = $this->locationConfigRepository->findLocation($adjacentLocation->id);

        $section = $adjacentLocationConfig['section'] ?? null;

        if (!isset($locationConfig['type']) && isset($adjacentLocationConfig['type'])
            || !isset($adjacentLocationConfig['type']) && isset($locationConfig['type'])
            || isset($locationConfig['type']) && isset($adjacentLocationConfig['type']) && $locationConfig['type'] !== $adjacentLocationConfig['type']
        ) {
            $section = null;
        }

        $icon = match ($adjacentLocationConfig['type'] ?? null) {
            LocationType::CITY  => "fas fa-city",
            LocationType::CAVE  => "fas fa-mountain",
            LocationType::TOWER => "far fa-building",
            LocationType::GYM   => "fas fa-dumbbell",
            default             => null,
        };

        if ($adjacentLocation->isInAVerticalDirection() || $adjacentLocation->isInACardinalDirection()) {
            $icon = null;
        }

        if ($adjacentLocation->isAnExit()) {
            $icon = "fas fa-door-open";
        }

        return new AdjacentLocationViewModel(
            $adjacentLocation->id,
            $adjacentLocationConfig['name'],
            $section,
            $adjacentLocation->isLocked,
            $icon,
        );
    }

    public function createNavigationBar(Features $features): NavigationBar
    {
        return new NavigationBar(
            $features->hasPokemon(),
            $features->hasTrainers,
            $features->hasEliteFour,
            $features->hasFacilities,
        );
    }
}
