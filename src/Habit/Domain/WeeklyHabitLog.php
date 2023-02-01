<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonPeriod;

final class WeeklyHabitLog
{
    public function __construct(
        public readonly Habit $habit,
        private readonly array $entries,
    ) {}

    public function record(WeeklyHabitLogEntry $entry): self
    {
        $entries = $this->entries;

        $entries[] = $entry;

        return new self(
            $this->habit,
            $entries
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
}
