<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCase\StartABattle;
use Exception;

final class PostBattleFinish
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly StartABattle $startABattleUseCase,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];

        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();

        $trainer = $trainer->endBattle();

        if ($eliteFourChallenge) {
            if ($trainer->hasBeenBeaten()) {
                if ($eliteFourChallenge->isInFinalStage()) {
                    $eliteFourChallenge = $eliteFourChallenge->win();
                } else {
                    $eliteFourChallenge = $eliteFourChallenge->proceedToNextStage();

                    $result = $this->startABattleUseCase->__invoke($eliteFourChallenge->getMemberIdForCurrentStage());

                    if (!$result->succeeded()) {
                        throw new Exception;
                    }
                }
            } else {
                $eliteFourChallenge = $eliteFourChallenge->lose();
            }
        }

        $this->trainerRepository->saveTrainer($trainer);
        $this->eliteFourChallengeRepository->save($eliteFourChallenge);

        if ($eliteFourChallenge && $eliteFourChallenge->isInProgress()) {
            header("Location: /battle/{$result->id}");
        } else {
            header("Location: /map");
        }
    }
}
