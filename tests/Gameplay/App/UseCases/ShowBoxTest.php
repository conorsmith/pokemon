<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowBox;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\DayCareFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PartyFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PokemonFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowBoxTest extends TestCase
{
    #[Test]
    function counts_pokemon()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox'     => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getParty'   => PartyFactory::any(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->filled,
            identicalTo(3),
        );
    }

    #[Test]
    function includes_each_pokemon_in_the_list()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox'     => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getParty'   => PartyFactory::any(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->pokemon,
                isInstanceOf(PokemonVm::class),
            );
        }
    }
}
