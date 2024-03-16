<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Pokedex;

interface PokedexEntryRepository
{
    public function all(): array;

    public function find(string $pokedexNumber): PokemonEntry;

    public function getFinalEntry(): PokemonEntry;

    public function register(string $pokedexNumber, ?string $form): bool;
}
