<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\UseCases\ShowBox;
use ConorSmith\Pokemon\Team\UseCases\ShowDayCare;
use ConorSmith\Pokemon\Team\UseCases\ShowEggs;
use ConorSmith\Pokemon\Team\UseCases\ShowTeam;
use ConorSmith\Pokemon\Team\UseCases\ShowTeamCoverage;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetTeam
{
    public function __construct(
        private readonly ShowTeam $showTeam,
        private readonly ShowEggs $showEggs,
        private readonly ShowDayCare $showDayCare,
        private readonly ShowBox $showBox,
        private readonly ShowTeamCoverage $showTeamCoverage,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Team.php", [
            'team'     => $this->showTeam->run(),
            'eggs'     => $this->showEggs->run(),
            'dayCare'  => $this->showDayCare->run(),
            'box'      => $this->showBox->run(),
            'coverage' => $this->showTeamCoverage->run(),
        ]));
    }
}
