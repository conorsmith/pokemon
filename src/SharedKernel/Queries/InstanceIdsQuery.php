<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface InstanceIdsQuery
{
    public function run(): array;
}
