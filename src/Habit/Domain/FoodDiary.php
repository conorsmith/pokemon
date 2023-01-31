<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;

final class FoodDiary
{
    public function __construct(
        private readonly array $dates,
    ) {}

    public function isTodayLogged(): bool
    {
        return count($this->dates) > 0 && $this->dates[0]->isToday();
    }

    public function isYesterdayLogged(): bool
    {
        return count($this->dates) > 0 && $this->dates[0]->isYesterday()
            || count($this->dates) > 1 && $this->dates[1]->isYesterday();
    }

    public function getStreak(): int
    {
        $workingDates = $this->dates;

        /** @var CarbonImmutable $latestDate */
        $latestDate = array_shift($workingDates);

        if (!$latestDate->isToday() && !$latestDate->isYesterday()) {
            return 0;
        }

        $streak = 1;

        /** @var CarbonImmutable $date */
        foreach ($workingDates as $date) {
            if ($date->diffInDays($latestDate) !== 1) {
                return $streak;
            }

            $streak++;
            $latestDate = $date;
        }

        return $streak;
    }
}
