<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengeTeamMember;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use Ramsey\Uuid\Uuid;

final class GenerateAChallenge
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
    ) {}

    public function __invoke(): ResultOfGeneratingAChallenge
    {
        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();

        if (!is_null($eliteFourChallenge)) {
            return ResultOfGeneratingAChallenge::notGenerated();
        }

        $regionIds = RegionId::all();

        $regionIds = array_filter($regionIds, fn (RegionId $regionId) => match ($regionId) {
            RegionId::KANTO => true,
            RegionId::JOHTO => true,
            RegionId::HOENN => true,
            default => false,
        });

        foreach ($regionIds as $regionId) {

            $leagueChampion = $this->leagueChampionRepository->find($regionId);

            if (!$leagueChampion->isPlayer()) {
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

            /** @var Trainer $randomTrainer */
            $randomTrainer = $trainers[$randomKey];

            $eliteFourChallenge = $this->eliteFourChallengeRepository->createEliteFourChallenge(
                Uuid::uuid4()->toString(),
                $regionId,
                $randomTrainer->id,
                array_map(
                    fn(Pokemon $pokemon) => new EliteFourChallengeTeamMember(
                        $pokemon->id,
                        $pokemon->number,
                        $pokemon->form,
                        $pokemon->level,
                    ),
                    $randomTrainer->team,
                ),
                4,
                false,
                null,
            );

            $this->eliteFourChallengeRepository->save($eliteFourChallenge);

            return ResultOfGeneratingAChallenge::generated(
                $regionId,
                $randomTrainer->id,
            );
        }

        return ResultOfGeneratingAChallenge::notGenerated();
    }
}
