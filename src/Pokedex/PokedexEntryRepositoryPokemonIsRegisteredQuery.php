<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\Pokedex\Domain\FormEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\PokemonIsRegisteredQuery;

final class PokedexEntryRepositoryPokemonIsRegisteredQuery implements PokemonIsRegisteredQuery
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
    ) {}

    public function run(string $pokedexNumber, ?string $form): bool
    {
        $entry = $this->pokedexEntryRepository->find($pokedexNumber);

        if (!$entry->isRegistered) {
            return false;
        }

        if (is_null($form)) {
            return true;
        }

        if (count($entry->forms) === 0) {
            return true;
        }

        /** @var FormEntry $formEntry */
        foreach ($entry->forms as $formEntry) {
            if ($formEntry->id === $form
                && $formEntry->isRegistered
            ) {
                return true;
            }
        }

        return false;
    }
}
