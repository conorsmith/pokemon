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
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
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

    public function __invoke(bool $dryRun, bool $isBenchmark): ResultOfGeneratingAChallenge
    {
        if ($isBenchmark) {
            self::disableOutput();
        }

        $eliteFourChallenge = $this->eliteFourChallengeRepository->findActive();

        if (!is_null($eliteFourChallenge)) {
            self::output("There is an existing Elite Four Challenge in progress" . PHP_EOL);
            self::output(PHP_EOL);
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

            self::output("## {$regionId->name}" . PHP_EOL);
            self::output(PHP_EOL);

            if (!$isBenchmark) {
                $leagueChampion = $this->leagueChampionRepository->find($regionId);

                if (!$leagueChampion->isPlayer()) {
                    self::output("The player is not the league champion" . PHP_EOL);
                    self::output(PHP_EOL);
                    continue;
                }
            }

            if (RandomNumberGenerator::coinToss()
                || RandomNumberGenerator::coinToss()
                || RandomNumberGenerator::coinToss()
            ) {
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

            self::output(TrainerClass::getLabel($randomTrainer->class) . " {$randomTrainer->name} challenges the Elite Four [{$randomTrainer->id}]" . PHP_EOL);
            self::output(PHP_EOL);

            /** @var Pokemon $pokemon */
            foreach ($randomTrainer->party as $pokemon) {
                $pokemonVm = $this->viewModelFactory->createPokemonInBattle($pokemon);
                self::output("* {$pokemonVm->name} [Lv {$pokemonVm->level}]" . PHP_EOL);
            }

            self::output(PHP_EOL);

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

                self::output("### {$eliteFourMember->name}" . PHP_EOL);
                self::output(PHP_EOL);

                $result = $this->simulateABattle->run($randomTrainer, $eliteFourMember, $isBenchmark);

                if ($result->wasDraw) {
                    self::output("It's a draw!" . PHP_EOL);
                    self::output(PHP_EOL);
                } else {
                    self::output("The winner is " . TrainerClass::getLabel($result->getWinningTrainer()->class) . " " . $result->getWinningTrainer()->name . PHP_EOL);
                    self::output(PHP_EOL);
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

                if (!$dryRun && !$isBenchmark) {

                    $bag = $this->bagRepository->find();
                    $bag = $bag->add(ItemId::CHALLENGE_TOKEN);
                    $this->bagRepository->save($bag);

                    $this->trainerRepository->saveTrainer($randomTrainer);
                    $this->eliteFourChallengeRepository->save($eliteFourChallenge);

                }

                if ($isBenchmark) {
                    echo TrainerClass::getLabel($randomTrainer->class) . " {$randomTrainer->name} challenges the Elite Four [{$randomTrainer->id}]" . PHP_EOL;
                    echo PHP_EOL;

                    /** @var Pokemon $pokemon */
                    foreach ($randomTrainer->party as $pokemon) {
                        $pokemonVm = $this->viewModelFactory->createPokemonInBattle($pokemon);
                        echo "* {$pokemonVm->name} [Lv {$pokemonVm->level}]" . PHP_EOL;
                    }
                }

                return ResultOfGeneratingAChallenge::generated(
                    $regionId,
                    $randomTrainer->id,
                );
            }
        }

        return ResultOfGeneratingAChallenge::notGenerated();
    }

    private static $isOutputDisabled = false;

    private static function disableOutput(): void
    {
        self::$isOutputDisabled = true;
    }

    private static function output(string $message): void
    {
        if (self::$isOutputDisabled) {
            return;
        }

        echo $message;
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
