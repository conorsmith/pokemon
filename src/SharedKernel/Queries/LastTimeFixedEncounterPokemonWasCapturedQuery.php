<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

use DateTimeImmutable;

interface LastTimeFixedEncounterPokemonWasCapturedQuery
{
    public function run(string $fixedEncounterId): ?DateTimeImmutable;
}
