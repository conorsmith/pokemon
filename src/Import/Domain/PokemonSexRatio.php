<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonSexRatio
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly int $femaleWeight,
        public readonly int $maleWeight,
        public readonly int $unknownWeight,
    ) {}
}
