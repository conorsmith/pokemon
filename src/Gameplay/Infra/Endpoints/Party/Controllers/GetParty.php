<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowParty;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowPartyCoverage;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetParty
{
    public function __construct(
        private readonly ShowParty $showParty,
        private readonly ShowPartyCoverage $showPartyCoverage,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Party.php", [
            'party'    => $this->showParty->run(),
            'coverage' => $this->showPartyCoverage->run(),
        ]));
    }
}
