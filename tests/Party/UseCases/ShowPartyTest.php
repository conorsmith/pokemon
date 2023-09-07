<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Party\UseCases;

use ConorSmith\Pokemon\Party\Domain\Party;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\UseCases\ShowParty;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Party\Domain\DayCareFactory;
use ConorSmith\PokemonTest\Party\Domain\PartyFactory;
use ConorSmith\PokemonTest\Party\Domain\PokemonFactory;
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

    #[Test]
    function with_more_than_one_party_member_all_can_be_sent_to_box()
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

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToBox,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function a_lone_party_member_cannot_be_sent_to_box()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canSendToBox,
            identicalTo(false),
        );
    }

    #[Test]
    function with_more_than_one_party_member_all_can_be_sent_to_day_care()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::notFull(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function party_members_cannot_be_sent_to_day_care_if_it_is_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::full(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(false),
            );
        }
    }

    #[Test]
    function a_lone_party_member_cannot_be_sent_to_day_care()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getParty'   => new Party([
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::notFull(),
        ]);

        $useCase = new ShowParty($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canSendToDayCare,
            identicalTo(false),
        );
    }
}
