<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Egg;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggParents;
use ConorSmith\Pokemon\Gameplay\Domain\Party\EggRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Stats;
use ConorSmith\Pokemon\PokedexConfigRepository;
use LogicException;
use Ramsey\Uuid\Uuid;

final class AddNewEgg
{
    public function __construct(
        private readonly EggRepository $eggRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function run(
        string $pokedexNumber,
        ?string $form,
        Stats $ivs,
        ?EggParents $parents,
    ): void {
        $egg = new Egg(
            Uuid::uuid4()->toString(),
            $pokedexNumber,
            $form,
            $ivs,
            $parents,
            $this->findEggCycles($pokedexNumber),
        );

        $this->eggRepository->save($egg);
    }

    private function findEggCycles(string $pokedexNumber): int
    {
        return match ($this->pokedexConfigRepository->find($pokedexNumber)['eggCycles']) {
            5       => 1,
            10      => 3,
            15      => 6,
            20      => 9,
            25      => 12,
            30      => 15,
            35      => 18,
            40      => 21,
            default => throw new LogicException(),
        };
    }
}
