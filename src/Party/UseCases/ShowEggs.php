<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Egg;
use ConorSmith\Pokemon\Party\Domain\EggRepository;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Egg as EggVm;
use ConorSmith\Pokemon\Party\ViewModels\EggsList;

final class ShowEggs
{
    public function __construct(
        private readonly EggRepository $eggRepository,
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(): EggsList
    {
        $eggs = $this->eggRepository->all();

        return new EggsList(
            count($eggs) === 0,
            count($eggs),
            array_map(
                fn (Egg $egg) => EggVm::create(
                    $egg,
                    $this->pokemonRepository->find($egg->firstParentId),
                    $this->pokemonRepository->find($egg->secondParentId),
                ),
                $eggs,
            )
        );
    }
}
