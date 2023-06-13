<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCase\CreateALegendaryEncounter;
use ConorSmith\Pokemon\Battle\UseCase\StartAnEncounter;

final class PostEncounterGenerateAndStart
{
    public function __construct(
        private readonly CreateALegendaryEncounter $createALegendaryEncounter,
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(): void
    {
        $legendaryPokemonNumber = $_POST['legendary'];

        $result = $this->createALegendaryEncounter->__invoke($legendaryPokemonNumber);

        $this->startAnEncounter->__invoke($result->encounter->id);

        header("Location: /encounter/{$result->encounter->id}");
    }
}
