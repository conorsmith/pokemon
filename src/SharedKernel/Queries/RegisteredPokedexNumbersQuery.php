<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface RegisteredPokedexNumbersQuery
{
    public function run(): array;
}
