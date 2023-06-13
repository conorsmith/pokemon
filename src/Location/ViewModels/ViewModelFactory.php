<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

use ConorSmith\Pokemon\Direction;
use ConorSmith\Pokemon\Location\Domain\AdjacentLocation;
use ConorSmith\Pokemon\Location\Domain\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\LocationType;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class ViewModelFactory
{
    public function __construct(
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function createLocation(Location $location): LocationViewModel
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

        $otherDirections = [];

        /** @var AdjacentLocation $adjacentLocation */
        foreach ($location->adjacentLocations as $adjacentLocation) {
            $adjacentLocationViewModel = $this->createAdjacentLocationViewModel($adjacentLocation);

            if ($adjacentLocation->isInACardinalDirection()) {
                $hasCardinalDirections = true;
                $cardinalDirections[$adjacentLocation->direction] = $adjacentLocationViewModel;

            } elseif ($adjacentLocation->isInAVerticalDirection()) {
                $hasVerticalDirections = true;
                $verticalDirections[$adjacentLocation->direction] = $adjacentLocationViewModel;

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
            },
            $locationConfig['section'] ?? null,
            $hasCardinalDirections,
            $hasVerticalDirections,
            $cardinalDirections[Direction::N],
            $cardinalDirections[Direction::S],
            $cardinalDirections[Direction::E],
            $cardinalDirections[Direction::W],
            $verticalDirections[Direction::U],
            $verticalDirections[Direction::D],
            $otherDirections,
        );
    }

    public function createAdjacentLocationViewModel(AdjacentLocation $adjacentLocation): AdjacentLocationViewModel
    {
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

        if ($adjacentLocation->isInAVerticalDirection()) {
            $icon = null;
        }

        return new AdjacentLocationViewModel(
            $adjacentLocation->id,
            $adjacentLocationConfig['name'],
            $section,
            $adjacentLocation->isLocked,
            $icon,
        );
    }
}