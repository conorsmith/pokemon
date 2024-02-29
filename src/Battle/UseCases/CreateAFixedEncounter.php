<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;

final class CreateAFixedEncounter
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly EncounterRepository $encounterRepository,
        private readonly LocationRepository $locationRepository,
    ) {}

    public function __invoke(string $pokedexNumber): ResultOfCreatingAnEncounter
    {
        $bag = $this->bagRepository->find();

        $currentLocation = $this->locationRepository->findCurrentLocation();

        $encounter = $this->encounterRepository->generateFixedEncounter(
            $currentLocation,
            $pokedexNumber,
        );
        $bag = $bag->use(ItemId::OVAL_CHARM);

        $this->encounterRepository->save($encounter);
        $this->bagRepository->save($bag);

        return new ResultOfCreatingAnEncounter($encounter);
    }
}
