<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

interface WeeklyUpdateForPartyCommand
{
    public function run(): void;
}
