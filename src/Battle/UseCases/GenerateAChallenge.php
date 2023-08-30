<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class GenerateAChallenge
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
    ) {}

    public function __invoke(): ResultOfGeneratingAChallenge
    {
        $regionIds = RegionId::all();

        foreach ($regionIds as $regionId) {

            $eliteFourChallenge = $this->eliteFourChallengeRepository->findVictoryInRegion($regionId);

            if (is_null($eliteFourChallenge) || !$eliteFourChallenge->victory) {
                continue;
            }

            if (RandomNumberGenerator::generateInRange(1, 10) !== 10) {
                continue;
            }

            $trainers = $this->trainerRepository->findTrainersInRegion($regionId);

            $randomKey = RandomNumberGenerator::generateInRange(
                array_keys($trainers)[0],
                array_keys($trainers)[count($trainers) - 1],
            );

            return ResultOfGeneratingAChallenge::generated(
                $regionId,
                $trainers[$randomKey]->id
            );
        }

        return ResultOfGeneratingAChallenge::notGenerated();
    }
}
