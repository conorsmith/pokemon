<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Battle;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use Ramsey\Uuid\Uuid;

final class StartABattle
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
        private readonly FriendshipEventLogRepository $friendshipEventLogRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly TrainerRepository $trainerRepository,
    ) {}

    public function __invoke(string $trainerId, bool $isPlayerChallenger = true): ResultOfStartingABattle
    {
        $battle = $this->battleRepository->findForTrainer($trainerId);
        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainerByTrainerId($trainerId);

        if (is_null($battle)) {
            $battle = new Battle(
                Uuid::uuid4()->toString(),
                $trainerId,
                $isPlayerChallenger,
                null,
                1,
            );
        } else {
            if ($isPlayerChallenger) {
                $battle = $battle->setPlayerAsChallenger();
            } else {
                $battle = $battle->setTrainerAsChallenger();
            }
        }

        if ($trainer->isGymLeader() || $trainer->isEliteFourOrEquivalent()) {
            /** @var Pokemon $pokemon */
            foreach ($player->party as $pokemon) {
                $this->friendshipEventLogRepository->battleWithGymLeader($pokemon->id);
            }
        }

        $trainer = $trainer->startBattle();
        $trainer = $trainer->reviveParty();
        $player = $player->startBattle($battle);
        $player = $player->reviveParty();

        $this->playerRepository->savePlayer($player);
        $this->battleRepository->save($battle);
        $this->trainerRepository->saveTrainer($trainer);

        return ResultOfStartingABattle::success($battle->id);
    }
}