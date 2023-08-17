<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Team\ViewModels\PokemonList;

final class ShowTeam
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $team = $this->pokemonRepository->getTeam();
        $dayCare = $this->pokemonRepository->getDayCare();

        return new PokemonList(
            $team->count(),
            6,
            array_map(
                fn(int $i, Pokemon $pokemon) => (object) [
                    'pokemon'          => PokemonVm::create($pokemon),
                    'canMoveUp'        => $i > 0,
                    'canMoveDown'      => $i < $team->count() - 1,
                    'canSendToBox'     => $team->count() > 1,
                    'canSendToDayCare' => $team->count() > 1 && !$dayCare->isFull(),
                ],
                array_keys($team->members),
                array_values($team->members),
            )
        );
    }
}
