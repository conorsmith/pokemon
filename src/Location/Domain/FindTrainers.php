<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Queries\AllGymTrainersHaveBeenDefeatedQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeTrainerWasBeatenQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\PlayerIsLeagueChampionQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\RegionalVictoryQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TrainerConfigRepository;

final class FindTrainers
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly AllGymTrainersHaveBeenDefeatedQuery $allGymTrainersHaveBeenDefeatedQuery,
        private readonly LastTimeTrainerWasBeatenQuery $lastTimeTrainerWasBeatenQuery,
        private readonly PlayerIsLeagueChampionQuery $playerIsLeagueChampionQuery,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
    ) {}

    public function find(string $locationId): array
    {
        $trainersInLocation = $this->trainerConfigRepository->findTrainersInLocation($locationId);
        $bag = $this->bagRepository->find();

        $challengeTokens = $bag->count(ItemId::CHALLENGE_TOKEN);

        $trainers = [];

        if (!is_null($trainersInLocation)) {
            foreach ($trainersInLocation as $config) {

                $lastBeaten = $this->lastTimeTrainerWasBeatenQuery->run($config['id']);

                if (!is_null($lastBeaten)) {
                    $lastBeaten = (new CarbonImmutable($lastBeaten));
                    $isInCooldownWindow = $lastBeaten->addWeek() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
                } else {
                    $isInCooldownWindow = false;
                }

                $hasCompletedPrerequisite = true;

                if (array_key_exists('leader', $config)) {
                    $hasCompletedPrerequisite = $this->allGymTrainersHaveBeenDefeatedQuery->run($locationId);
                }

                if (array_key_exists('prerequisite', $config)
                    && array_key_exists('victory', $config['prerequisite'])
                ) {
                    if (!$this->regionalVictoryQuery->run($config['prerequisite']['victory'])) {
                        continue;
                    }
                }

                if (array_key_exists('prerequisite', $config)
                    && array_key_exists('champion', $config['prerequisite'])
                ) {
                    if (!$this->playerIsLeagueChampionQuery->run($config['prerequisite']['champion'])) {
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
}
