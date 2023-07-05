<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Team\ViewModels\PokemonList;

final class ShowBox
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $team = $this->pokemonRepository->getTeam();
        $dayCare = $this->pokemonRepository->getDayCare();
        $box = $this->pokemonRepository->getBox();

        return new PokemonList(
            count($box),
            PHP_INT_MAX,
            array_map(
                fn(Pokemon $pokemon) => (object) [
                    'pokemon'          => PokemonVm::create($pokemon),
                    'canSendToTeam'    => !$team->isFull(),
                    'canSendToDayCare' => !$dayCare->isFull(),
                ],
                $box
            )
        );
    }
}
