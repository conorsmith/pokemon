<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface AreaIsClearedQuery
{
    public function run(string $locationId): bool;
}
