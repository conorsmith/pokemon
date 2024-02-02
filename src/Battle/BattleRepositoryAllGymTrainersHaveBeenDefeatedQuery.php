<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Battle;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\AllGymTrainersHaveBeenDefeatedQuery;
use ConorSmith\Pokemon\TrainerConfigRepository;
use LogicException;

final class BattleRepositoryAllGymTrainersHaveBeenDefeatedQuery implements AllGymTrainersHaveBeenDefeatedQuery
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
    ) {}

    public function run(string $locationId): bool
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
