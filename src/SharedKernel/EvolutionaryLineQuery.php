<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface EvolutionaryLineQuery
{
    public function run(string $pokedexNumber): array;
}
