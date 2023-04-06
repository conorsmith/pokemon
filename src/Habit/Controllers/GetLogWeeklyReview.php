<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\TemplateEngine;

final class GetLogWeeklyReview
{
    public function __construct(
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        $lastMonday = $today->previous("Monday");

        if (!$today->isMonday()) {
            $lastMonday = $lastMonday->subWeek();
        }

        echo $this->templateEngine->render(__DIR__ . "/../Templates/WeeklyReview.php", [
            'lastMonday' => $lastMonday->format("Y-m-d"),
        ]);
    }
}
