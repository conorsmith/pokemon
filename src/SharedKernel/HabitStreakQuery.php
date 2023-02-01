<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface HabitStreakQuery
{
    public function run(): int;
}
