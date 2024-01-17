<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\EliteFourChallengePartyMember;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\ViewModelFactory;
use LogicException;
use Ramsey\Uuid\Uuid;

final class GenerateAChallenge
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly BagRepository $bagRepository,
        private readonly SimulateABattle $simulateABattle,
        private readonly RandomTrainerGenerator $randomTrainerGenerator,
        private readonly ViewModelFactory $viewModelFactory,
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

            $eliteFourLeader = $this->trainerRepository->findTrainerByTrainerId(
                self::findEliteFourConfig($regionId)['members'][3]['id'],
            );

            $randomTrainer = $this->randomTrainerGenerator->generate(
                self::findHighestLevelOfPartyMembers($eliteFourLeader),
                match ($regionId) {
                    RegionId::KANTO => LocationId::KANTO_LEAGUE_CHAMBER,
                    RegionId::JOHTO => LocationId::JOHTO_LEAGUE_CHAMBER,
                    RegionId::HOENN => LocationId::HOENN_POKEMON_LEAGUE,
                    default => throw new LogicException(),
                }
            );

            echo TrainerClass::getLabel($randomTrainer->class) . " {$randomTrainer->name} challenges the Elite Four [{$randomTrainer->id}]" . PHP_EOL;
            echo PHP_EOL;

            /** @var Pokemon $pokemon */
            foreach ($randomTrainer->party as $pokemon) {
                $pokemonVm = $this->viewModelFactory->createPokemonInBattle($pokemon);
                echo "* {$pokemonVm->name} [Lv {$pokemonVm->level}]" . PHP_EOL;
            }

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

                $eliteFourMember = $this->trainerRepository->findTrainerByTrainerId(
                    $eliteFourChallenge->getMemberIdForCurrentStage(),
                );

                echo "### {$eliteFourMember->name}" . PHP_EOL;
                echo PHP_EOL;

                $result = $this->simulateABattle->run($randomTrainer, $eliteFourMember);

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
                    $randomTrainer = $randomTrainer->reviveParty();
                    $eliteFourChallenge = $eliteFourChallenge->proceedToNextStage();
                }
            }

            if ($eliteFourChallenge->isInFinalStage()) {

                $bag = $this->bagRepository->find();
                $bag = $bag->add(ItemId::CHALLENGE_TOKEN);
                $this->bagRepository->save($bag);

                $this->trainerRepository->saveTrainer($randomTrainer);
                $this->eliteFourChallengeRepository->save($eliteFourChallenge);

                return ResultOfGeneratingAChallenge::generated(
                    $regionId,
                    $randomTrainer->id,
                );
            }
        }

        return ResultOfGeneratingAChallenge::notGenerated();
    }

    private static function findEliteFourConfig(RegionId $region): ?array
    {
        $eliteFourConfig = require __DIR__ . "/../../Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            if ($config['region'] === $region) {
                return $config;
            }
        }

        return null;
    }

    private static function findHighestLevelOfPartyMembers(Trainer $trainer): int
    {
        $max = 0;

        /** @var Pokemon $partyMember */
        foreach ($trainer->party as $partyMember) {
            if ($partyMember->level > $max) {
                $max = $partyMember->level;
            }
        }

        return $max;
    }
}
