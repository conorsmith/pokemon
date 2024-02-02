<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeTrainerWasBeatenQuery;
use DateTimeImmutable;

final class BattleRepositoryLastTimeTrainerWasBeatenQuery implements LastTimeTrainerWasBeatenQuery
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
    ) {}

    public function run(string $trainerId): ?DateTimeImmutable
    {
        $battle = $this->battleRepository->findForTrainer($trainerId);

        if (is_null($battle)) {
            return null;
        }

        return $battle->dateLastBeaten;
    }
}
