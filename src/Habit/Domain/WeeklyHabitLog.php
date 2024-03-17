<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use DateTimeImmutable;

final class WeeklyHabitLog
{
    public function __construct(
        public readonly Habit $habit,
        private readonly array $entries,
        public readonly DateTimeImmutable $startedAt,
    ) {}

    public function record(WeeklyHabitLogEntry $entry): self
    {
        $entries = $this->entries;

        $entries[] = $entry;

        return new self(
            $this->habit,
            $entries,
            $this->startedAt,
        );
    }

    public function isWeekLogged(CarbonPeriod $week): bool
    {
        /** @var WeeklyHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->week->equalTo($week)) {
                return true;
            }
        }

        return false;
    }

    public function doesWeekPredateLog(CarbonPeriod $week): bool
    {
        return $week->end->midDay()
            ->isBefore(
                (new CarbonImmutable($this->startedAt))->midDay()
            );
    }

    public function diff(self $other): array
    {
        $entries = [];

        /** @var WeeklyHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if (!$other->contains($entry)) {
                $entries[] = $entry;
            }
        }

        return $entries;
    }

    private function contains(WeeklyHabitLogEntry $givenEntry): bool
    {
        /** @var WeeklyHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->equals($givenEntry)) {
                return true;
            }
        }

        return false;
    }

    public function getEntryForWeek(CarbonPeriod $givenWeek): ?WeeklyHabitLogEntry
    {
        /** @var WeeklyHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->week->equalTo($givenWeek)) {
                return $entry;
            }
        }

        return null;
    }
}
