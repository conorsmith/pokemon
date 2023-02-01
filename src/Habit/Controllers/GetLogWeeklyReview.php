<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetLogWeeklyReview
{
    public function __construct(
        private readonly Session $session,
    ) {}

    public function __invoke(): void
    {
        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        $lastMonday = $today->previous("Monday");

        if (!$today->isMonday()) {
            $lastMonday = $lastMonday->subWeek();
        }

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/WeeklyReview.php", [
            'lastMonday' => $lastMonday->format("Y-m-d"),
            'errors' => $errors,
        ]);
    }
}
