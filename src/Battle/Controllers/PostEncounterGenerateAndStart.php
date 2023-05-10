<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCase\CreateALegendaryEncounter;
use ConorSmith\Pokemon\Battle\UseCase\CreateAWildEncounter;
use ConorSmith\Pokemon\Battle\UseCase\StartAnEncounter;

final class PostEncounterGenerateAndStart
{
    public function __construct(
        private readonly CreateAWildEncounter $createAWildEncounter,
        private readonly CreateALegendaryEncounter $createALegendaryEncounter,
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(): void
    {
        $encounterType = $_POST['encounterType'] ?? null;
        $legendaryPokemonNumber = $_POST['legendary'] ?? null;

        if ($legendaryPokemonNumber) {
            $result = $this->createALegendaryEncounter->__invoke($legendaryPokemonNumber);
        } else {
            $result = $this->createAWildEncounter->__invoke($encounterType);
        }

        $this->startAnEncounter->__invoke($result->encounter->id);

        header("Location: /encounter/{$result->encounter->id}");
    }
}
