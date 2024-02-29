<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface FixedEncounterQuery
{
    public function run(string $locationId, string $pokedexNumber): ?FixedEncounterResult;
}
