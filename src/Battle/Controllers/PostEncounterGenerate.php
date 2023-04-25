<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCase\CreateAWildEncounter;
use ConorSmith\Pokemon\ViewModelFactory;

final class PostEncounterGenerate
{
    public function __construct(
        private readonly CreateAWildEncounter $createAWildEncounter,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(): void
    {
        $encounterType = $_POST['encounterType'];

        $result = $this->createAWildEncounter->__invoke($encounterType);

        $encounter = $result->encounter;

        echo json_encode([
            "id"           => $encounter->id,
            "isRegistered" => $encounter->isRegistered,
            "pokemon"      => $this->viewModelFactory->createPokemonInBattle($encounter->pokemon),
        ]);
    }
}