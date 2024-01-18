<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Party\ViewModels\PokemonList;

final class ShowDayCare
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $dayCare = $this->pokemonRepository->getDayCare();

        return new PokemonList(
            $dayCare->count(),
            $dayCare->availablePlaces,
            array_map(
                fn(Pokemon $pokemon) => (object) [
                    'pokemon' => PokemonVm::create($pokemon),
                ],
                $dayCare->attendees
            )
        );
    }
}
