<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\CreateAWildEncounter;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterGenerate
{
    public function __construct(
        private readonly CreateAWildEncounter $createAWildEncounter,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterType = $request->request->get('encounterType');

        $result = $this->createAWildEncounter->__invoke($encounterType);

        $encounter = $result->encounter;

        return new JsonResponse([
            "id"           => $encounter->id,
            "isRegistered" => $encounter->isRegistered,
            "pokemon"      => $this->viewModelFactory->createPokemonInBattle($encounter->pokemon),
        ]);
    }
}