<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Battle;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\Domain\PlayerRepository;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use Ramsey\Uuid\Uuid;

final class StartABattle
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
    ) {}

    public function __invoke(string $trainerId): ResultOfStartingABattle
    {
        $battle = $this->battleRepository->findForTrainer($trainerId);
        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);

        if (is_null($battle)) {
            $battle = new Battle(
                Uuid::uuid4()->toString(),
                $trainerId,
                null,
                1,
            );
        }

        if ($trainer->isGymLeader() || $trainer->isEliteFourOrEquivalent()) {
            $this->reportBattleWithGymLeaderCommand->run(array_map(
                fn(Pokemon $pokemon) => $pokemon->id,
                $player->team,
            ));
        }

        $trainer = $trainer->startBattle();
        $player = $player->startBattle($battle);
        $player = $player->reviveTeam();

        $this->playerRepository->savePlayer($player);
        $this->battleRepository->save($battle);
        $this->trainerRepository->saveTrainer($trainer);

        return ResultOfStartingABattle::success($battle->id);
    }
}