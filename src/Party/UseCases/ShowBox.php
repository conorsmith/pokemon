<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Party\ViewModels\PokemonList;

final class ShowBox
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();
        $box = $this->pokemonRepository->getBox();

        return new PokemonList(
            count($box),
            PHP_INT_MAX,
            array_map(
                fn(Pokemon $pokemon) => (object) [
                    'pokemon'          => PokemonVm::create($pokemon),
                    'canSendToParty'   => !$party->isFull(),
                    'canSendToDayCare' => !$dayCare->isFull(),
                ],
                $box
            )
        );
    }
}
