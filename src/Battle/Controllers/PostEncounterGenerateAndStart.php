<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCases\CreateALegendaryEncounter;
use ConorSmith\Pokemon\Battle\UseCases\StartAnEncounter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterGenerateAndStart
{
    public function __construct(
        private readonly CreateALegendaryEncounter $createALegendaryEncounter,
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $legendaryPokemonNumber = $request->request->get('legendary');

        $result = $this->createALegendaryEncounter->__invoke($legendaryPokemonNumber);

        $this->startAnEncounter->__invoke($result->encounter->id);

        return new RedirectResponse("/{$args['instanceId']}/encounter/{$result->encounter->id}");
    }
}
