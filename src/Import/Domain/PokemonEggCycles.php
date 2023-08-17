<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonEggCycles
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly int $value,
    ) {}
}
