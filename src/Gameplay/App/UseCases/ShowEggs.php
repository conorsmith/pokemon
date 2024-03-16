<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Egg as EggVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\EggsList;

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
