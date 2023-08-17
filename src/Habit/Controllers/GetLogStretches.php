<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetLogStretches
{
    public function __construct(
        private readonly DailyHabitLogRepository $habitLogRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $habitLog = $this->habitLogRepository->find(Habit::STRETCHES_COMPLETED);

        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Stretches.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'isTodayLogged' => $habitLog->isTodayLogged(),
            'isYesterdayLogged' => $habitLog->isYesterdayLogged(),
        ]));
    }
}
