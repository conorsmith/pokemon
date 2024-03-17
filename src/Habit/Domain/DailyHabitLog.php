<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use DateTimeImmutable;

final class DailyHabitLog
{
    public function __construct(
        public readonly Habit $habit,
        private readonly array $dates,
        public readonly DateTimeImmutable $startedAt,
    ) {}

    public function record(CarbonImmutable $recordedDate): self
    {
        $dates = [$recordedDate->midDay()];

        /** @var CarbonImmutable $date */
        foreach ($this->dates as $date) {
            $dates[] = $date;
        }

        usort(
            $dates,
            fn (CarbonImmutable $a, CarbonImmutable $b) => $a->isBefore($b) ? 1 : -1,
        );

        return new self(
            $this->habit,
            $dates,
            $this->startedAt,
        );
    }

    public function diff(self $other): array
    {
        $dates = [];

        foreach ($this->dates as $date) {
            if (!$other->isDateLogged($date)) {
                $dates[] = $date;
            }
        }

        return $dates;
    }

    public function isTodayLogged(): bool
    {
        return count($this->dates) > 0 && $this->dates[0]->isToday();
    }

    public function isYesterdayLogged(): bool
    {
        return count($this->dates) > 0 && $this->dates[0]->isYesterday()
            || count($this->dates) > 1 && $this->dates[1]->isYesterday();
    }

    public function isDateLogged(CarbonImmutable $givenDate): bool
    {
        /** @var CarbonImmutable $date */
        foreach ($this->dates as $date) {
            if ($date->midDay()->equalTo($givenDate->midDay())) {
                return true;
            }
        }

        return false;
    }

    public function doesDatePredateLog(CarbonImmutable $givenDate): bool
    {
        return $givenDate->midDay()
            ->isBefore(
                (new CarbonImmutable($this->startedAt))->midDay()
            );
    }

    public function count(CarbonPeriod $period): int
    {
        $count = 0;

        /** @var CarbonImmutable $date */
        foreach ($this->dates as $date) {
            if ($period->contains($date)) {
                $count++;
            }
        }

        return $count;
    }

    public function getStreak(): int
    {
        $workingDates = $this->dates;

        if (count($workingDates) === 0) {
            return 0;
        }

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
