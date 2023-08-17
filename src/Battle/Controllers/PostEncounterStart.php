<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCases\StartAnEncounter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterStart
{
    public function __construct(
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];

        $this->startAnEncounter->__invoke($encounterId);

        return new RedirectResponse("/{$args['instanceId']}/encounter/{$encounterId}");
    }
}
