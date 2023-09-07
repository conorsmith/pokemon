<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface HabitStreakQuery
{
    public function run(): int;
}
