<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Habit\Domain\DailyHabitLog;
use ConorSmith\Pokemon\Habit\Domain\EntryType;
use ConorSmith\Pokemon\Habit\Domain\UnlimitedHabitLog;
use DomainException;

final class Calendar
{
    public static function generateForDailyHabitLog(DailyHabitLog $habitLog): self
    {
        $startDate = new CarbonImmutable("2023-01-01 00:00:00", new CarbonTimeZone("Europe/Dublin"));

        $runningMonth = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
        $runningDay = $runningMonth->setDay(1);

        $months = [];

        while ($runningMonth->isAfter($startDate)) {

            $weeks = [];

            $squares = [];

            for ($i = 0; $i < $runningDay->getDaysFromStartOfWeek(1); $i++) {
                $squares[] = CalendarSquare::empty();
            }

            while ($runningDay->month === $runningMonth->month) {

                $calendarSquare = new CalendarSquare(
                    new CalendarSquareContents(
                        (string) $runningDay->day,
                        "&nbsp;",
                    ),
                    false,
                    $habitLog->isDateLogged($runningDay),
                    $runningDay->isFuture(),
                );

                $squares[] = $calendarSquare;
                $runningDay = $runningDay->addDay();

                if ($runningDay->getDaysFromStartOfWeek(1) === 0) {
                    $weeks[] = new CalendarWeek($squares);
                    $squares = [];
                }
            }

            if ($runningDay->getDaysFromStartOfWeek(1) > 0) {
                for ($i = $runningDay->getDaysFromStartOfWeek(1); $i < 7; $i++) {
                    $squares[] = CalendarSquare::empty();
                }
            }

            $weeks[] = new CalendarWeek($squares);

            $months[] = new CalendarMonth(
                "{$runningMonth->englishMonth} {$runningMonth->year}",
                $weeks,
            );

            $runningMonth = $runningMonth->subMonth();
            $runningDay = $runningMonth->setDay(1);
        }

        return new self($months);
    }

    public static function generateForUnlimitedHabitLog(UnlimitedHabitLog $habitLog): self
    {
        $startDate = new CarbonImmutable("2023-01-01 00:00:00", new CarbonTimeZone("Europe/Dublin"));

        $runningMonth = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
        $runningDay = $runningMonth->setDay(1);

        $months = [];

        while ($runningMonth->isAfter($startDate)) {

            $weeks = [];

            $squares = [];

            for ($i = 0; $i < $runningDay->getDaysFromStartOfWeek(1); $i++) {
                $squares[] = CalendarSquare::empty();
            }

            while ($runningDay->month === $runningMonth->month) {

                $logCount = $habitLog->countLoggedOnDate($runningDay);

                $calendarSquare = new CalendarSquare(
                    new CalendarSquareContents(
                        (string) $runningDay->day,
                        match ($logCount) {
                            0 => "&nbsp;",
                            1 => self::renderEntryTypeIcon(
                                $habitLog->getEntriesOnDate($runningDay)[0]->entryType
                            ),
                            default => "<strong>{$logCount}</strong>",
                        }
                    ),
                    false,
                    $logCount > 0,
                    $runningDay->isFuture(),
                );

                $squares[] = $calendarSquare;
                $runningDay = $runningDay->addDay();

                if ($runningDay->getDaysFromStartOfWeek(1) === 0) {
                    $weeks[] = new CalendarWeek($squares);
                    $squares = [];
                }
            }

            if ($runningDay->getDaysFromStartOfWeek(1) > 0) {
                for ($i = $runningDay->getDaysFromStartOfWeek(1); $i < 7; $i++) {
                    $squares[] = CalendarSquare::empty();
                }
            }

            $weeks[] = new CalendarWeek($squares);

            $months[] = new CalendarMonth(
                "{$runningMonth->englishMonth} {$runningMonth->year}",
                $weeks,
            );

            $runningMonth = $runningMonth->subMonth();
            $runningDay = $runningMonth->setDay(1);
        }

        return new self($months);
    }

    private static function renderEntryTypeIcon(EntryType $entryType)
    {
        return match ($entryType) {
            EntryType::SHORT_WALK => "<i class=\"fas fa-fw fa-walking\">",
            EntryType::LONG_WALK  => "<i class=\"fas fa-fw fa-hiking\">",
            EntryType::RUN        => "<i class=\"fas fa-fw fa-running\">",
        };
    }

    public function __construct(
        public readonly array $months,
    ) {
        foreach ($this->months as $month) {
            if (!$month instanceof CalendarMonth) {
                $requiredType = CalendarMonth::class;
                $givenType = get_debug_type($month);
                throw new DomainException(
                    "Invalid type. Required `{$requiredType}`. Given `{$givenType}`."
                );
            }
        }
    }
}
