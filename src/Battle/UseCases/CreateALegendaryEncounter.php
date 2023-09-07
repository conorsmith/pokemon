<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;

final class CreateALegendaryEncounter
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
        private readonly BagRepository $bagRepository,
    ) {}

    public function __invoke(string $legendaryPokemonNumber): ResultOfCreatingAnEncounter
    {
        $bag = $this->bagRepository->find();

        $encounter = $this->encounterRepository->generateLegendaryEncounter($legendaryPokemonNumber);
        $bag = $bag->use(ItemId::CHALLENGE_TOKEN);

        $this->encounterRepository->save($encounter);
        $this->bagRepository->save($bag);

        return new ResultOfCreatingAnEncounter($encounter);
    }
}
