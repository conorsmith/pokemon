<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit;

use ConorSmith\Pokemon\Habit\Domain\Habit;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;

final class FoodDiaryHabitStreakQuery implements HabitStreakQuery
{
    public function __construct(
        private readonly DailyHabitLogRepository $habitLogRepository,
    ) {}

    public function run(): int
    {
        $habitLog = $this->habitLogRepository->find(Habit::FOOD_DIARY_COMPLETED);

        return $habitLog->getStreak();
    }
}
