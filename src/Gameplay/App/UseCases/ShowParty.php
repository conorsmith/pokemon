<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\PokemonList;

final class ShowParty
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $party = $this->pokemonRepository->getParty();

        return new PokemonList(
            $party->count(),
            6,
            array_map(
                fn(int $i, Pokemon $pokemon) => (object) [
                    'pokemon'     => PokemonVm::create($pokemon),
                    'canMoveUp'   => $i > 0,
                    'canMoveDown' => $i < $party->count() - 1,
                ],
                array_keys($party->members),
                array_values($party->members),
            )
        );
    }
}
