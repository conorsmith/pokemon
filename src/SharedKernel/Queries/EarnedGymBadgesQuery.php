<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface EarnedGymBadgesQuery
{
    public function run(): int;
}
