<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;

final class PostBattleFinish
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];

        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);

        $trainer = $trainer->endBattle();

        $this->trainerRepository->saveTrainer($trainer);

        header("Location: /map");
    }
}
