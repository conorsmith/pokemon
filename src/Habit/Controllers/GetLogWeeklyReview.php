<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetLogWeeklyReview
{
    public function __construct(
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        $lastMonday = $today->previous("Monday");

        if (!$today->isMonday()) {
            $lastMonday = $lastMonday->subWeek();
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/WeeklyReview.php", [
            'lastMonday' => $lastMonday->format("Y-m-d"),
        ]));
    }
}
