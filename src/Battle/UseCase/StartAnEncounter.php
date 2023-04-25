<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCase;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;

final class StartAnEncounter
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
    ) {}

    public function __invoke(string $encounterId): void
    {
        $encounter = $this->encounterRepository->find($encounterId);

        $encounter = $encounter->start();

        $this->encounterRepository->save($encounter);
    }
}
