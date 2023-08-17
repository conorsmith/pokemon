<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class TrainerPokemon
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly Sex $sex,
        public readonly int $level,
    ) {}
}
