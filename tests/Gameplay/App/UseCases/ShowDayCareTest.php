<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\DayCare;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowDayCare;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\DayCareFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PartyFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PokemonFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowDayCareTest extends TestCase
{
    #[Test]
    function counts_attendees()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getDayCare' => DayCareFactory::withAttendees([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getParty'   => PartyFactory::any(),
        ]);

        $useCase = new ShowDayCare($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->filled,
            identicalTo(3),
        );
    }

    #[Test]
    function counts_available_places()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getDayCare' => new DayCare([], 12),
            'getParty'   => PartyFactory::any(),
        ]);


        $useCase = new ShowDayCare($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->maximum,
            identicalTo(12),
        );
    }

    #[Test]
    function includes_each_attendee_in_the_list()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getDayCare' => DayCareFactory::withAttendees([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getParty'   => PartyFactory::any(),
        ]);

        $useCase = new ShowDayCare($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->pokemon,
                isInstanceOf(PokemonVm::class),
            );
        }
    }
}
