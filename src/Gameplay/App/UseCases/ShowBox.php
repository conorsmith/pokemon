<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\PokemonList;

final class ShowBox
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): PokemonList
    {
        $box = $this->pokemonRepository->getBox();

        return new PokemonList(
            count($box),
            PHP_INT_MAX,
            array_map(
                fn(Pokemon $pokemon) => (object) [
                    'pokemon'          => PokemonVm::create($pokemon),
                ],
                $box
            )
        );
    }
}
