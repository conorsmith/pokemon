<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Area;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\LocationConfigRepository;

final class AreaRepository
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
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
            $battles = $this->battleRepository->findBattlesInLocation($locationId);

            return new Area($locationId, $trainers, $battles);
        }

        $locations = $this->locationConfigRepository->findLocationsInArea($location['area']);

        $trainers = [];
        $battles = [];

        foreach ($locations as $location) {
            $trainers = array_merge(
                $trainers,
                $this->trainerRepository->findTrainersInLocation($location['id']),
            );
            $battles = array_merge(
                $battles,
                $this->battleRepository->findBattlesInLocation($location['id']),
            );
        }

        return new Area($location['area'], $trainers, $battles);
    }
}
