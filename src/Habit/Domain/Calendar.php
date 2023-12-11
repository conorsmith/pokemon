<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;

final class Calendar
{
    public static function generate(DailyHabitLog $habitLog): array
    {
        $startDate = new CarbonImmutable("2023-01-01 00:00:00", new CarbonTimeZone("Europe/Dublin"));

        $runningMonth = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
        $runningDay = $runningMonth->setDay(1);

        $calendar = [];

        while ($runningMonth->isAfter($startDate)) {

            $calendarMonth = [
                'year'  => $runningMonth->year,
                'month' => $runningMonth->englishMonth,
                'weeks' => [],
            ];

            $week = [];

            for ($i = 0; $i < $runningDay->getDaysFromStartOfWeek(1); $i++) {
                $week[] = null;
            }

            while (!$runningDay->isFuture() && $runningDay->month === $runningMonth->month) {
                if ($runningDay->getDaysFromStartOfWeek(1) === 0) {
                    $calendarMonth['weeks'][] = $week;
                    $week = [];
                }

                $week[] = [
                    'day'      => $runningDay->day,
                    'isLogged' => $habitLog->isDateLogged($runningDay),
                ];
                $runningDay = $runningDay->addDay();
            }

            if ($runningDay->getDaysFromStartOfWeek(1) > 0) {
                for ($i = $runningDay->getDaysFromStartOfWeek(1); $i < 7; $i++) {
                    $week[] = null;
                }
            }

            $calendarMonth['weeks'][] = $week;

            $calendar[] = $calendarMonth;

            $runningMonth = $runningMonth->subMonth();
            $runningDay = $runningMonth->setDay(1);
        }

        return $calendar;
    }
}