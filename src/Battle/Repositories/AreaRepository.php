<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;

final class AreaRepository
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly array $locationConfig,
    ) {}

    public function find(string $locationId): ?Area
    {
        $location = $this->findLocation($locationId);

        if (is_null($location)) {
            return null;
        }

        if (!array_key_exists('area', $location)) {
            $trainers = $this->trainerRepository->findTrainersInLocation($locationId);

            return new Area($locationId, $trainers);
        }

        $locations = $this->findLocationsInArea($location['area']);

        $trainers = [];

        foreach ($locations as $location) {
            $trainers = array_merge(
                $trainers,
                $this->trainerRepository->findTrainersInLocation($location['id']),
            );
        }

        return new Area($location['area'], $trainers);
    }

    private function findLocation(string $locationId): ?array
    {
        foreach ($this->locationConfig as $configEntry) {
            if ($configEntry['id'] === $locationId) {
                return $configEntry;
            }
        }

        return null;
    }

    private function findLocationsInArea(string $areaId): array
    {
        $locations = [];

        foreach ($this->locationConfig as $configEntry) {
            if (isset($configEntry['area']) && $configEntry['area'] === $areaId) {
                $locations[] = $configEntry;
            }
        }

        return $locations;
    }
}
