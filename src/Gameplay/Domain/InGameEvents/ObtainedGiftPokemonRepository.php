<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\InGameEvents;

interface ObtainedGiftPokemonRepository
{
    public function findMostRecent(string $pokedexNumber, string $locationId): ?ObtainedGiftPokemon;

    public function save(ObtainedGiftPokemon $obtainedGiftPokemon): void;
}
