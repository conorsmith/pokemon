<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface TrainerHasBeenBeatenQuery
{
    public function run(string $trainerId): bool;
}
