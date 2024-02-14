<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

interface PokemonIsRegisteredQuery
{
    public function run(string $pokedexNumber, ?string $form): bool;
}
