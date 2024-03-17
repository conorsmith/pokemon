<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;
use DateTimeImmutable;

final class UnlimitedHabitLog
{
    public function __construct(
        public readonly Habit $habit,
        private readonly array $entries,
        public readonly DateTimeImmutable $startedAt,
    ) {}

    public function record(UnlimitedHabitLogEntry $entry): self
    {
        $entries = $this->entries;

        $entries[] = $entry;

        return new self(
            $this->habit,
            $entries,
            $this->startedAt,
        );
    }

    public function diff(self $other): array
    {
        $entries = [];

        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if (!$other->contains($entry)) {
                $entries[] = $entry;
            }
        }

        return $entries;
    }

    private function contains(UnlimitedHabitLogEntry $givenEntry): bool
    {
        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->equals($givenEntry)) {
                return true;
            }
        }

        return false;
    }

    public function countLoggedToday(): int
    {
        $count = 0;

        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->date->isToday()) {
                $count++;
            }
        }

        return $count;
    }

    public function countLoggedYesterday(): int
    {
        $count = 0;

        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->date->isYesterday()) {
                $count++;
            }
        }

        return $count;
    }


    public function countLoggedOnDate(CarbonImmutable $givenDate): int
    {
        $count = 0;

        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->date->midDay()->equalTo($givenDate->midDay())) {
                $count++;
            }
        }

        return $count;
    }

    public function doesDatePredateLog(CarbonImmutable $givenDate): bool
    {
        return $givenDate->midDay()
            ->isBefore(
                (new CarbonImmutable($this->startedAt))->midDay()
            );
    }


    public function getEntriesOnDate(CarbonImmutable $givenDate): array
    {
        $entries = [];

        /** @var UnlimitedHabitLogEntry $entry */
        foreach ($this->entries as $entry) {
            if ($entry->date->midDay()->equalTo($givenDate->midDay())) {
                $entries[] = $entry;
            }
        }

        return $entries;
    }
}
