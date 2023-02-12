<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface WeeklyUpdateForTeamCommand
{
    public function run(): void;
}
