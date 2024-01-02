<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Habit\ViewModels;

final class ListWeek
{
    public function __construct(
        public readonly string $date,
        public readonly string $entry,
    ) {}
}
