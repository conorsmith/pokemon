<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface TotalRegisteredPokemonQuery
{
    public function run(): int;
}
