<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\LocationConfigRepository;

final class AreaRepository
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function find(string $locationId): ?Area
    {
        $location = $this->locationConfigRepository->findLocation($locationId);

        if (is_null($location)) {
            return null;
        }

        if (!array_key_exists('area', $location)) {
            $trainers = $this->trainerRepository->findTrainersInLocation($locationId);

            return new Area($locationId, $trainers);
        }

        $locations = $this->locationConfigRepository->findLocationsInArea($location['area']);

        $trainers = [];

        foreach ($locations as $location) {
            $trainers = array_merge(
                $trainers,
                $this->trainerRepository->findTrainersInLocation($location['id']),
            );
        }

        return new Area($location['area'], $trainers);
    }
}
