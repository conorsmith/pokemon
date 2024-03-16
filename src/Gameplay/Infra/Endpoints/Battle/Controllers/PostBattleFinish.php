<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampion;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartABattle;
use Exception;
use LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostBattleFinish
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly TrainerRepository $trainerRepository,
        private readonly BattleRepository $battleRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly StartABattle $startABattleUseCase,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $trainerBattleId = $args['id'];

        $player = $this->playerRepository->findPlayer();
        $trainer = $this->trainerRepository->findTrainer($trainerBattleId);
        $battle = $this->battleRepository->find($trainerBattleId);
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();
        $leagueChampion = null;

        $player = $player->endBattle();
        $trainer = $trainer->endBattle();

        $this->playerRepository->savePlayer($player);

        if ($eliteFourChallenge) {
            if ($eliteFourChallenge->isPlayerTheChallenger()) {
                if ($trainer->hasEntirePartyFainted()) {
                    if ($eliteFourChallenge->isInFinalStage()) {
                        $eliteFourChallenge = $eliteFourChallenge->win();
                        $leagueChampion = LeagueChampion::player($eliteFourChallenge->region);
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
            } else {
                if ($trainer->hasEntirePartyFainted()) {
                    $eliteFourChallenge = $eliteFourChallenge->lose();
                } else {
                    if ($eliteFourChallenge->isInFinalStage()) {
                        $eliteFourChallenge = $eliteFourChallenge->win();
                        $leagueChampion = new LeagueChampion(
                            $eliteFourChallenge->region,
                            $trainer->id,
                        );
                    } else {
                        throw new Exception("Player should only face a challenger in the final stage");
                    }
                }
            }
        }

        $this->trainerRepository->saveTrainer($trainer);
        if ($eliteFourChallenge) {
            $this->eliteFourChallengeRepository->save($eliteFourChallenge);
        }
        if (!is_null($leagueChampion)) {
            $this->leagueChampionRepository->save($leagueChampion);
        }

        if ($eliteFourChallenge && $eliteFourChallenge->isInProgress()) {
            if (!isset($result)) {
                throw new LogicException();
            }
            return new RedirectResponse("/{$args['instanceId']}/battle/{$result->id}");
        } elseif ($battle->isPlayerChallenger) {
            return new RedirectResponse("/{$args['instanceId']}/map/trainers");
        } else {
            return new RedirectResponse("/{$args['instanceId']}/");
        }
    }
}
