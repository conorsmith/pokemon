<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\ReduceEggCyclesCommand as CommandInterface;
use ConorSmith\Pokemon\Team\Domain\Egg;
use ConorSmith\Pokemon\Team\Domain\EggRepository;

final class ReduceEggCyclesCommand implements CommandInterface
{
    public function __construct(
        private readonly EggRepository $eggRepository,
    ) {}

    public function run(int $amount): void
    {
        $eggs = $this->eggRepository->all();

        /** @var Egg $egg */
        foreach ($eggs as $egg) {
            $egg = $egg->reduceCycles($amount);
            $this->eggRepository->save($egg);
        }

        // TODO: Handle hatching
    }
}
