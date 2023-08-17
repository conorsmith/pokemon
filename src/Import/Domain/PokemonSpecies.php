<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonSpecies
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly string $name,
        public readonly PokemonType $type,
        public readonly array $evolutions,
        public readonly int $friendship,
    ) {}

    public function hasEvolutions(): bool
    {
        return count($this->evolutions) > 0;
    }
}
