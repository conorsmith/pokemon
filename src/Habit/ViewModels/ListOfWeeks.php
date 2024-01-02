<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\WeeklyHabitLog;
use DomainException;

final class ListOfWeeks
{
    public static function generateForWeeklyHabitLog(WeeklyHabitLog $habitLog): self
    {
        $startDate = new CarbonImmutable("2023-01-01 00:00:00", new CarbonTimeZone("Europe/Dublin"));

        $today = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        $runningMonday = $today->isMonday() ? $today : $today->previous("Monday");
        $runningMonday = $runningMonday->midDay();

        $weeks = [];

        while ($runningMonday->isAfter($startDate)) {

            $entry = $habitLog->getEntryForWeek(
                new CarbonPeriod($runningMonday, $runningMonday->addDays(6))
            );

            $weeks[] = new ListWeek(
                $runningMonday->format("Y-m-d"),
                is_null($entry) ? "&mdash;" : number_format($entry->value),
            );

            $runningMonday = $runningMonday->subWeek();
        }

        return new self($weeks);
    }

    public function __construct(
        public readonly array $weeks,
    ) {
        foreach ($this->weeks as $week) {
            if (!$week instanceof ListWeek) {
                $requiredType = ListWeek::class;
                $givenType = get_debug_type($week);
                throw new DomainException(
                    "Invalid type. Required `{$requiredType}`. Given `{$givenType}`."
                );
            }
        }
    }
}
