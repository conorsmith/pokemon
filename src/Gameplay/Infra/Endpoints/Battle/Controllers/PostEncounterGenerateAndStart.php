<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\CreateAFixedEncounter;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartAnEncounter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterGenerateAndStart
{
    public function __construct(
        private readonly CreateAFixedEncounter $createAFixedEncounter,
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokedexNumber = $request->request->get('pokedexNumber');

        $result = $this->createAFixedEncounter->__invoke($pokedexNumber);

        $this->startAnEncounter->__invoke($result->encounter->id);

        return new RedirectResponse("/{$args['instanceId']}/encounter/{$result->encounter->id}");
    }
}
