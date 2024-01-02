<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengePartyMember;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use Ramsey\Uuid\Uuid;

final class GenerateAChallenge
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly SimulateABattle $simulateABattle,
    ) {}

    public function __invoke(): ResultOfGeneratingAChallenge
    {
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();

        if (!is_null($eliteFourChallenge)) {
            echo "There is an existing Elite Four Challenge in progress" . PHP_EOL;
            echo PHP_EOL;
            return ResultOfGeneratingAChallenge::notGenerated();
        }

        $regionIds = RegionId::all();

        $regionIds = array_filter($regionIds, fn (RegionId $regionId) => match ($regionId) {
            RegionId::KANTO => true,
            RegionId::JOHTO => true,
            RegionId::HOENN => true,
            default         => false,
        });

        foreach ($regionIds as $regionId) {

            echo "## {$regionId->name}" . PHP_EOL;
            echo PHP_EOL;

            $leagueChampion = $this->leagueChampionRepository->find($regionId);

            if (!$leagueChampion->isPlayer()) {
                echo "The player is not the league champion" . PHP_EOL;
                echo PHP_EOL;
                continue;
            }

            echo "Randomly selecting a trainer from the region" . PHP_EOL;

            $randomTrainer = $this->trainerRepository->findRandomTrainerFromRegion($regionId);

            echo TrainerClass::getLabel($randomTrainer->class) . " {$randomTrainer->name} challenges the Elite Four" . PHP_EOL;
            echo PHP_EOL;

            $eliteFourChallenge = $this->eliteFourChallengeRepository->createEliteFourChallenge(
                Uuid::uuid4()->toString(),
                $regionId,
                $randomTrainer->id,
                array_map(
                    fn(Pokemon $pokemon) => new EliteFourChallengePartyMember(
                        $pokemon->id,
                        $pokemon->number,
                        $pokemon->form,
                        $pokemon->level,
                    ),
                    $randomTrainer->party,
                ),
                0,
                false,
                null,
            );

            while ($eliteFourChallenge->isInProgress() && !$eliteFourChallenge->isInFinalStage()) {

                $result = $this->simulateABattle->run($randomTrainer->id, $eliteFourChallenge->getMemberIdForCurrentStage());

                if ($result->wasDraw) {
                    echo "It's a draw!" . PHP_EOL;
                    echo PHP_EOL;
                } else {
                    echo "The winner is " . TrainerClass::getLabel($result->getWinningTrainer()->class) . " " . $result->getWinningTrainer()->name . PHP_EOL;
                    echo PHP_EOL;
                }

                if ($result->wasDraw || $result->getWinningTrainer()->id !== $randomTrainer->id) {

                    $eliteFourChallenge = $eliteFourChallenge->lose();

                    break;

                } else {
                    $eliteFourChallenge = $eliteFourChallenge->proceedToNextStage();
                }
            }

            if ($eliteFourChallenge->isInFinalStage()) {

                $this->eliteFourChallengeRepository->save($eliteFourChallenge);

                return ResultOfGeneratingAChallenge::generated(
                    $regionId,
                    $randomTrainer->id,
                );
            }
        }

        return ResultOfGeneratingAChallenge::notGenerated();
    }
}
