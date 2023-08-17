<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;

final class CreateAWildEncounter
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
        private readonly LocationRepository $locationRepository,
    ) {}

    public function __invoke(string $encounterType): ResultOfCreatingAnEncounter
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();

        $encounter = $this->encounterRepository->generateWildEncounter(
            $currentLocation,
            $encounterType,
        );

        $this->encounterRepository->save($encounter);
        $this->encounterRepository->deleteOldestEncountersOutsideLimit();

        return new ResultOfCreatingAnEncounter($encounter);
    }
}