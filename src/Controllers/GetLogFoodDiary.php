<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Repositories\FoodDiaryRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetLogFoodDiary
{
    public function __construct(
        private readonly Session $session,
        private readonly FoodDiaryRepository $foodDiaryRepository,
    ) {}

    public function __invoke(): void
    {
        $foodDiary = $this->foodDiaryRepository->find();

        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/FoodDiary.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'isTodayLogged' => $foodDiary->isTodayLogged(),
            'isYesterdayLogged' => $foodDiary->isYesterdayLogged(),
            'streak' => $foodDiary->getStreak(),
            'errors' => $errors,
        ]);
    }
}
