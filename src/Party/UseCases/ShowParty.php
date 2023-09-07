<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Party\ViewModels\PokemonList;

final class ShowParty
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();

        return new PokemonList(
            $party->count(),
            6,
            array_map(
                fn(int $i, Pokemon $pokemon) => (object) [
                    'pokemon'          => PokemonVm::create($pokemon),
                    'canMoveUp'        => $i > 0,
                    'canMoveDown'      => $i < $party->count() - 1,
                    'canSendToBox'     => $party->count() > 1,
                    'canSendToDayCare' => $party->count() > 1 && !$dayCare->isFull(),
                ],
                array_keys($party->members),
                array_values($party->members),
            )
        );
    }
}
