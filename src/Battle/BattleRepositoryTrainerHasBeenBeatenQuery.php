<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\TrainerHasBeenBeatenQuery;

final class BattleRepositoryTrainerHasBeenBeatenQuery implements TrainerHasBeenBeatenQuery
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
    ) {}

    public function run(string $trainerId): bool
    {
        $battle = $this->battleRepository->findForTrainer($trainerId);

        if (is_null($battle)) {
            return false;
        }

        return $battle->playerHasWon();
    }
}
