<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use DateTimeImmutable;

interface LastTimeTrainerWasBeatenQuery
{
    public function run(string $trainerId): ?DateTimeImmutable;
}
