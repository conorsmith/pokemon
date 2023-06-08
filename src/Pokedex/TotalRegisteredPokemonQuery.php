<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\SharedKernel\TotalRegisteredPokemonQuery as TotalRegisteredPokemonQueryInterface;

final class TotalRegisteredPokemonQuery implements TotalRegisteredPokemonQueryInterface
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
    ) {}

    public function run(): int
    {
        $registeredEntries = array_filter(
            $this->pokedexEntryRepository->all(),
            fn (PokemonEntry $entry) => $entry->isRegistered,
        );

        return count($registeredEntries);
    }
}
