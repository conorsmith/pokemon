<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\EggRepository;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\UseCases\ShowEggs;
use ConorSmith\Pokemon\Team\ViewModels\Egg as EggVm;
use ConorSmith\PokemonTest\Team\Domain\EggFactory;
use ConorSmith\PokemonTest\Team\Domain\PokemonFactory;
use ConorSmith\PokemonTest\TestDouble;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowEggsTest extends TestCase
{
    #[Test]
    function says_when_it_is_empty()
    {
        $useCase = new ShowEggs(
            ($eggRepository = TestDouble::stub(EggRepository::class))->reveal(),
            ($pokemonRepository = TestDouble::stub(PokemonRepository::class))->reveal(),
        );

        $eggRepository->all()
            ->willReturn([]);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->isEmpty,
            identicalTo(true)
        );
    }

    #[Test]
    function counts_eggs()
    {
        $useCase = new ShowEggs(
            ($eggRepository = TestDouble::stub(EggRepository::class))->reveal(),
            ($pokemonRepository = TestDouble::stub(PokemonRepository::class))->reveal(),
        );

        $eggRepository->all()
            ->willReturn([
                EggFactory::any(),
                EggFactory::any(),
                EggFactory::any(),
            ]);

        $pokemonRepository->find(Argument::any())
            ->willReturn(PokemonFactory::any());

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->filled,
            identicalTo(3)
        );
    }


    #[Test]
    function includes_each_egg_in_the_list()
    {
        $useCase = new ShowEggs(
            ($eggRepository = TestDouble::stub(EggRepository::class))->reveal(),
            ($pokemonRepository = TestDouble::stub(PokemonRepository::class))->reveal(),
        );

        $eggRepository->all()
            ->willReturn([
                EggFactory::any(),
                EggFactory::any(),
                EggFactory::any(),
            ]);

        $pokemonRepository->find(Argument::any())
            ->willReturn(PokemonFactory::any());

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot,
                isInstanceOf(EggVm::class)
            );
        }
    }

    #[Test]
    function fetches_egg_parents_to_create_view_model()
    {
        $useCase = new ShowEggs(
            ($eggRepository = TestDouble::stub(EggRepository::class))->reveal(),
            ($pokemonRepository = TestDouble::stub(PokemonRepository::class))->reveal(),
        );

        $eggRepository->all()
            ->willReturn([
                EggFactory::create(
                    firstParentId: "first-parent-id",
                    secondParentId: "second-parent-id",
                ),
            ]);

        $pokemonRepository->find("first-parent-id")
            ->willReturn(PokemonFactory::create(number: "25"));

        $pokemonRepository->find("second-parent-id")
            ->willReturn(PokemonFactory::create(number: "150"));

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->slots[0]->firstParent->name,
            identicalTo("Pikachu")
        );

        assertThat(
            $viewModel->slots[0]->secondParent->name,
            identicalTo("Mewtwo")
        );
    }
}
