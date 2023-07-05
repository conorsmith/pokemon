<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\UseCases\ShowBox;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Team\Domain\DayCareFactory;
use ConorSmith\PokemonTest\Team\Domain\PokemonFactory;
use ConorSmith\PokemonTest\Team\Domain\TeamFactory;
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
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::any(),
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
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::any(),
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

    #[Test]
    function all_pokemon_can_be_sent_to_team_if_it_is_not_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::notFull(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToTeam,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function no_pokemon_can_be_sent_to_team_if_it_is_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::full(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToTeam,
                identicalTo(false),
            );
        }
    }

    #[Test]
    function all_pokemon_can_be_sent_to_day_care_if_it_is_not_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::any(),
            'getDayCare' => DayCareFactory::notFull(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function no_pokemon_can_be_sent_to_day_care_if_it_is_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getBox' => [
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ],
            'getTeam' => TeamFactory::any(),
            'getDayCare' => DayCareFactory::full(),
        ]);

        $useCase = new ShowBox($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(false),
            );
        }
    }
}
