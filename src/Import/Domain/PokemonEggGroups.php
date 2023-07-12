<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonEggGroups
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly EggGroup $firstEggGroup,
        public readonly ?EggGroup $secondEggGroup,
    ) {}
}
