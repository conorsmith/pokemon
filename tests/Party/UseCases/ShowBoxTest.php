<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\UseCases\ShowBox;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Party\Domain\DayCareFactory;
use ConorSmith\PokemonTest\Party\Domain\PartyFactory;
use ConorSmith\PokemonTest\Party\Domain\PokemonFactory;
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
