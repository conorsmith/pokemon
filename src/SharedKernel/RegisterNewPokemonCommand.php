<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface RegisterNewPokemonCommand
{
    public function run(string $pokedexNumber, ?string $form): void;
}
