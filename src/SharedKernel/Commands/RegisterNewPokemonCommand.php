<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

interface RegisterNewPokemonCommand
{
    public function run(string $pokedexNumber, ?string $form): void;
}
