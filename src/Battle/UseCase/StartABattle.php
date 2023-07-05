<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCase;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\ReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;

final class StartABattle
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly ReportBattleWithGymLeaderCommand $reportBattleWithGymLeaderCommand,
    ) {}

    public function __invoke(string $trainerId): ResultOfStartingABattle
    {
        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();

        $bag = $this->bagRepository->find();

        if (is_null($eliteFourChallenge) && !$bag->has(ItemId::CHALLENGE_TOKEN)) {
            return ResultOfStartingABattle::failure();
        }

        if ($trainer->isGymLeader() || $trainer->isEliteFourOrEquivalent()) {
            $this->reportBattleWithGymLeaderCommand->run(array_map(
                fn(Pokemon $pokemon) => $pokemon->id,
                $player->team,
            ));
        }

        $trainer = $trainer->startBattle();
        $player = $player->reviveTeam();

        if (is_null($eliteFourChallenge)) {
            $bag = $bag->use(ItemId::CHALLENGE_TOKEN);
        }

        $this->playerRepository->savePlayer($player);
        $this->trainerRepository->saveTrainer($trainer);
        $this->bagRepository->save($bag);

        return ResultOfStartingABattle::success($trainer->id);
    }
}