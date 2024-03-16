<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Party;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\ShowParty;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\DayCareFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PartyFactory;
use ConorSmith\PokemonTest\Gameplay\Domain\Party\PokemonFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowPartyTest extends TestCase
{
    #[Test]
    function counts_party_members()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->filled,
            identicalTo(3),
        );
    }

    #[Test]
    function has_a_constant_maximum_of_six()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => PartyFactory::any(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->maximum,
            identicalTo(6),
        );
    }

    #[Test]
    function includes_each_party_member_in_the_list()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->pokemon,
                isInstanceOf(PokemonVm::class),
            );
        }
    }

    #[Test]
    function all_but_the_first_party_member_can_move_up()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canMoveUp,
            identicalTo(false),
        );

        assertThat(
            $viewModel->slots[1]->canMoveUp,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[2]->canMoveUp,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[3]->canMoveUp,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[4]->canMoveUp,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[5]->canMoveUp,
            identicalTo(true),
        );
    }

    #[Test]
    function all_but_the_last_party_member_can_move_down()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canMoveDown,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[1]->canMoveDown,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[2]->canMoveDown,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[3]->canMoveDown,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[4]->canMoveDown,
            identicalTo(true),
        );

        assertThat(
            $viewModel->slots[5]->canMoveDown,
            identicalTo(false),
        );
    }
}
