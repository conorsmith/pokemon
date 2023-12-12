<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

use DomainException;

final class CalendarMonth
{
    public function __construct(
        public readonly string $title,
        public readonly array $weeks,
    ) {
        foreach ($this->weeks as $week) {
            if (!$week instanceof CalendarWeek) {
                $requiredType = CalendarWeek::class;
                $givenType = get_debug_type($week);
                throw new DomainException(
                    "Invalid type. Required `{$requiredType}`. Given `{$givenType}`."
                );
            }
        }
    }
}
