<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface TeamPokemonQuery
{
    public function run(string $id): TeamPokemon;
}