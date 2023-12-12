<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

use DomainException;

final class CalendarWeek
{
    public function __construct(
        public readonly array $squares,
    ) {
        foreach ($this->squares as $square) {
            if (!$square instanceof CalendarSquare) {
                $requiredType = CalendarSquare::class;
                $givenType = get_debug_type($square);
                throw new DomainException(
                    "Invalid type. Required `{$requiredType}`. Given `{$givenType}`."
                );
            }
        }
    }
}
