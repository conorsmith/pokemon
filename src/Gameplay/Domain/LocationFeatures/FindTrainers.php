<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Battle;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TrainerConfigRepository;
use LogicException;

final class FindTrainers
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly BattleRepository $battleRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
    ) {}

    public function find(string $locationId): array
    {
        $trainersInLocation = $this->trainerConfigRepository->findTrainersInLocation($locationId);
        $bag = $this->bagRepository->find();

        $challengeTokens = $bag->count(ItemId::CHALLENGE_TOKEN);

        $trainers = [];

        if (!is_null($trainersInLocation)) {
            foreach ($trainersInLocation as $config) {

                $battle = $this->battleRepository->findForTrainer($config['id']);

                if (!is_null($battle) && !is_null($battle->dateLastBeaten)) {
                    $lastBeaten = (new CarbonImmutable($battle->dateLastBeaten));
                    $isInCooldownWindow = $lastBeaten->addWeek() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
                } else {
                    $lastBeaten = null;
                    $isInCooldownWindow = false;
                }

                $hasCompletedPrerequisite = true;

                if (array_key_exists('leader', $config)) {
                    $hasCompletedPrerequisite = $this->haveAllGymTrainersBeenDefeated($locationId);
                }

                if (array_key_exists('prerequisite', $config)
                    && array_key_exists('victory', $config['prerequisite'])
                ) {
                    $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($config['prerequisite']['victory']);

                    if (is_null($eliteFourChallenge)) {
                        continue;
                    }
                }

                if (array_key_exists('prerequisite', $config)
                    && array_key_exists('champion', $config['prerequisite'])
                ) {
                    $leagueChampion = $this->leagueChampionRepository->find($config['prerequisite']['champion']);

                    if (!$leagueChampion->isPlayer()) {
                        continue;
                    }
                }

                $trainers[] = new Trainer(
                    $config['id'],
                    count($config['party']),
                    !$isInCooldownWindow && $challengeTokens > 0 && $hasCompletedPrerequisite,
                    $lastBeaten,
                    array_key_exists('leader', $config),
                );
            }
        }

        return $trainers;
    }

    public function haveAllGymTrainersBeenDefeated(string $locationId): bool
    {
        if (!$this->hasGymLeader($locationId)) {
            throw new LogicException("Location has no Gym Leader");
        }

        $gymLeaderId = $this->findGymLeaderId($locationId);
        $gymTrainerIds = $this->findGymTrainerIds($locationId);
        $defeatedTrainerIds = [];

        $battles = $this->battleRepository->findBattlesInLocation($locationId);

        /** @var ?Battle $battle */
        foreach ($battles as $battle) {
            if (!is_null($battle)
                && $battle->playerHasWon()
                && $battle->trainerId !== $gymLeaderId
            ) {
                $defeatedTrainerIds[] = $battle->trainerId;
            }
        }

        sort($gymTrainerIds);
        sort($defeatedTrainerIds);

        return $gymTrainerIds === $defeatedTrainerIds;
    }

    private function hasGymLeader(string $locationId): bool
    {
        $configs = $this->trainerConfigRepository->findTrainersInLocation($locationId);

        foreach ($configs as $config) {
            if (array_key_exists('leader', $config)) {
                return true;
            }
        }

        return false;
    }

    private function findGymLeaderId(string $locationId): string
    {
        $configs = $this->trainerConfigRepository->findTrainersInLocation($locationId);

        foreach ($configs as $config) {
            if (array_key_exists('leader', $config)) {
                return $config['id'];
            }
        }

        throw new LogicException("Location has no Gym Leader");
    }

    private function findGymTrainerIds(string $locationId): array
    {
        $configs = $this->trainerConfigRepository->findTrainersInLocation($locationId);

        $gymTrainerIds = [];

        foreach ($configs as $config) {
            if (!array_key_exists('leader', $config)) {
                $gymTrainerIds[] = $config['id'];
            }
        }

        return $gymTrainerIds;
    }
}
