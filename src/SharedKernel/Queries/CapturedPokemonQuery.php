<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface CapturedPokemonQuery
{
    public function run(CapturedPokemonQueryParameters $parameters): array;
}
