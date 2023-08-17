<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Team\ViewModels\PokemonList;

final class ShowDayCare
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $team = $this->pokemonRepository->getTeam();
        $dayCare = $this->pokemonRepository->getDayCare();

        return new PokemonList(
            $dayCare->count(),
            $dayCare->availablePlaces,
            array_map(
                fn(Pokemon $pokemon) => (object) [
                    'pokemon'       => PokemonVm::create($pokemon),
                    'canSendToTeam' => !$team->isFull(),
                    'canSendToBox'  => true,
                ],
                $dayCare->attendees
            )
        );
    }
}
