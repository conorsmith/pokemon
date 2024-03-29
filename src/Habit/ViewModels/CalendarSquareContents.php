<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

final class CalendarSquareContents
{
    public function __construct(
        public readonly string $date,
        public readonly string $content,
    ) {}
}
