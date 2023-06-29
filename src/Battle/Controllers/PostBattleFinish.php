<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCase\StartABattle;
use Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostBattleFinish
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly StartABattle $startABattleUseCase,
    ) {}

    public function __invoke(Request $request, array $args): Response
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
        if ($eliteFourChallenge) {
            $this->eliteFourChallengeRepository->save($eliteFourChallenge);
        }

        if ($eliteFourChallenge && $eliteFourChallenge->isInProgress()) {
            return new RedirectResponse("/{$args['instanceId']}/battle/{$result->id}");
        } else {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }
    }
}
