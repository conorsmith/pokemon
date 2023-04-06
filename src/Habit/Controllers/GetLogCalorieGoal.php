<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\TemplateEngine;

class GetLogCalorieGoal
{
    public function __construct(
        private readonly DailyHabitLogRepository $habitLogRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $habitLog = $this->habitLogRepository->find(Habit::CALORIE_GOAL_ATTAINED);

        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        echo $this->templateEngine->render(__DIR__ . "/../Templates/CalorieGoal.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'isTodayLogged' => $habitLog->isTodayLogged(),
            'isYesterdayLogged' => $habitLog->isYesterdayLogged(),
        ]);
    }
}
