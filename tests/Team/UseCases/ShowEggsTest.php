<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\UseCases;

use ConorSmith\Pokemon\Team\Domain\EggRepository;
use ConorSmith\Pokemon\Team\UseCases\ShowEggs;
use ConorSmith\Pokemon\Team\ViewModels\Egg as EggVm;
use ConorSmith\PokemonTest\Team\Domain\EggFactory;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\identicalTo;
use function PHPUnit\Framework\isInstanceOf;

final class ShowEggsTest extends TestCase
{
    #[Test]
    function says_when_it_is_empty()
    {
        $eggRepository = $this->createConfiguredStub(EggRepository::class, [
            'all' => [],
        ]);

        $useCase = new ShowEggs($eggRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->isEmpty,
            identicalTo(true)
        );
    }

    #[Test]
    function counts_eggs()
    {
        $eggRepository = $this->createConfiguredStub(EggRepository::class, [
            'all' => [
                EggFactory::any(),
                EggFactory::any(),
                EggFactory::any(),
            ],
        ]);

        $useCase = new ShowEggs($eggRepository);

        $viewModel = $useCase->run();

        assertThat(
            $viewModel->filled,
            identicalTo(3)
        );
    }


    #[Test]
    function includes_each_egg_in_the_list()
    {
        $eggRepository = $this->createConfiguredStub(EggRepository::class, [
            'all' => [
                EggFactory::any(),
                EggFactory::any(),
                EggFactory::any(),
            ],
        ]);

        $useCase = new ShowEggs($eggRepository);

        $viewModel = $useCase->run();

        foreach ($viewModel->slots as $slot) {
            assertThat(
                $slot,
                isInstanceOf(EggVm::class)
            );
        }
    }
}
