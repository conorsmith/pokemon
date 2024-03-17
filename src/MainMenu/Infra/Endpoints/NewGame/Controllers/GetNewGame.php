<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Infra\Endpoints\NewGame\Controllers;

use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetNewGame
{
    public function __construct(
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        return new Response($this->templateEngine->renderWithoutLayout(__DIR__ . "/../Templates/NewGame.php", [
        ]));
    }
}
