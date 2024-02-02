<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use DateTimeImmutable;

interface LastTimeLegendaryPokemonWasCapturedQuery
{
    public function run(string $pokedexNumber): ?DateTimeImmutable;
}
