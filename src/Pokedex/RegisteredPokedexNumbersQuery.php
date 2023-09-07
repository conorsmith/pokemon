<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\RegisteredPokedexNumbersQuery as QueryInterface;

final class RegisteredPokedexNumbersQuery implements QueryInterface
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
    ) {}

    public function run(): array
    {
        $registeredEntries = array_filter(
            $this->pokedexEntryRepository->all(),
            fn(PokemonEntry $entry) => $entry->isRegistered,
        );

        return array_map(
            fn(PokemonEntry $entry) => $entry->pokedexNumber,
            $registeredEntries,
        );
    }
}
