<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowEggs;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyEggs
{
    public function __construct(
        private readonly ShowEggs $showEggs,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PartyEggs.php", [
            'eggs'     => $this->showEggs->run(),
        ]));
    }
}
