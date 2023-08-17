<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\Domain\Team;
use ConorSmith\Pokemon\Team\UseCases\ShowTeam;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\PokemonTest\Team\Domain\DayCareFactory;
use ConorSmith\PokemonTest\Team\Domain\PokemonFactory;
use ConorSmith\PokemonTest\Team\Domain\TeamFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowTeamTest extends TestCase
{
    #[Test]
    function counts_team_members()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

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
            'getTeam' => TeamFactory::any(),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->maximum,
            identicalTo(6),
        );
    }

    #[Test]
    function includes_each_team_member_in_the_list()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->pokemon,
                isInstanceOf(PokemonVm::class),
            );
        }
    }

    #[Test]
    function all_but_the_first_team_member_can_move_up()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

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
    function all_but_the_last_team_member_can_move_down()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

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
    function with_more_than_one_team_member_all_can_be_sent_to_box()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToBox,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function a_lone_team_member_cannot_be_sent_to_box()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::any(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canSendToBox,
            identicalTo(false),
        );
    }

    #[Test]
    function with_more_than_one_team_member_all_can_be_sent_to_day_care()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::notFull(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(true),
            );
        }
    }

    #[Test]
    function team_members_cannot_be_sent_to_day_care_if_it_is_full()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
                PokemonFactory::any(),
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::full(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot->canSendToDayCare,
                identicalTo(false),
            );
        }
    }

    #[Test]
    function a_lone_team_member_cannot_be_sent_to_day_care()
    {
        $pokemonRepository = $this->createConfiguredStub(PokemonRepository::class, [
            'getTeam' => new Team([
                PokemonFactory::any(),
            ]),
            'getDayCare' => DayCareFactory::notFull(),
        ]);

        $useCase = new ShowTeam($pokemonRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->canSendToDayCare,
            identicalTo(false),
        );
    }
}
