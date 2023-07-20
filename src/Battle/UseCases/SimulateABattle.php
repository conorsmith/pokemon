<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\TrainerClass;

final class SimulateABattle
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EventFactory $eventFactory,
    ) {}

    public function run(string $trainerAId, string $trainerBId): ?Trainer
    {
        $trainerA = $this->trainerRepository->findTrainerByTrainerId($trainerAId);
        $trainerB = $this->trainerRepository->findTrainerByTrainerId($trainerBId);

        $trainerA = $trainerA->startBattle();
        $trainerB = $trainerB->startBattle();

        while (!$trainerA->hasEntireTeamFainted() && !$trainerB->hasEntireTeamFainted()) {

            $trainerAPokemon = $trainerA->getLeadPokemon();
            $trainerBPokemon = $trainerB->getLeadPokemon();

            $round = Round::execute(
                $trainerAPokemon,
                $trainerBPokemon,
                Attack::strongest($trainerAPokemon),
                Attack::strongest($trainerBPokemon),
            );

            $this->outputRoundEvents($round, $trainerA, $trainerB);
        }

        $trainerA = $trainerA->endBattle();
        $trainerB = $trainerB->endBattle();

        $this->trainerRepository->saveTrainer($trainerA);
        $this->trainerRepository->saveTrainer($trainerB);

        if ($trainerB->hasEntireTeamFainted()) {
            return $trainerA;

        } elseif ($trainerA->hasEntireTeamFainted()) {
            return $trainerB;

        } else {
            return null;
        }
    }

    private function outputRoundEvents(Round $round, Trainer $trainerA, Trainer $trainerB): void
    {
        $nextFirstPokemon = $round->playerFirst
            ? ($trainerA->hasEntireTeamFainted() ? null : $trainerA->getLeadPokemon())
            : ($trainerB->hasEntireTeamFainted() ? null : $trainerB->getLeadPokemon());
        $nextSecondPokemon = $round->playerFirst
            ? ($trainerB->hasEntireTeamFainted() ? null : $trainerB->getLeadPokemon())
            : ($trainerA->hasEntireTeamFainted() ? null : $trainerA->getLeadPokemon());

        $events = array_merge(
            $this->eventFactory->createBattleRoundEvents(
                $round->firstAttack,
                $round->firstPokemon,
                $round->secondPokemon,
                !$round->playerFirst,
                $nextSecondPokemon,
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s"
                    : TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s",
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s"
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s",
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name,
            ),
            $this->eventFactory->createBattleRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s"
                    : TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s",
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s"
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s",
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name,
            ),
        );

        foreach ($events as $event) {
            if ($event['type'] === "message") {
                $message = $event['value'];
                echo $message . PHP_EOL;
            }
        }

        echo PHP_EOL;
    }
}
