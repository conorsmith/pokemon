<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetLogExercise
{
    public function __construct(
        private readonly Session $session,
        private readonly UnlimitedHabitLogRepository $habitLogRepository,
    ) {}

    public function __invoke(): void
    {
        $habitLog = $this->habitLogRepository->find(Habit::EXERCISE);

        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");
        $yesterday = CarbonImmutable::yesterday(new CarbonTimeZone("Europe/Dublin"))->format("Y-m-d");

        $errors = $this->session->getFlashBag()->get("errors");

        echo TemplateEngine::render(__DIR__ . "/../Templates/Exercise.php", [
            'today' => $today,
            'yesterday' => $yesterday,
            'loggedToday' => $habitLog->countLoggedToday(),
            'loggedYesterday' => $habitLog->countLoggedYesterday(),
            'errors' => $errors,
        ]);
    }
}
