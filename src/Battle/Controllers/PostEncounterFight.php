<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\TrainerClass;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostEncounterFight
{
    public function __construct(
        private readonly Session $session,
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly EventFactory $eventFactory,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterId = $args['id'];
        $playerAttackType = $_POST['attack'];

        $encounter = $this->encounterRepository->find($encounterId);
        $player = $this->playerRepository->findPlayer();

        if (is_null($encounter)) {
            $this->session->getFlashBag()->add("errors", "Encounter not found");
            header("Location: /map");
        }

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            header("Location: /encounter/{$encounter->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $encounter->pokemon;

        $round = Round::execute($playerPokemon, $opponentPokemon, $playerAttackType);

        if ($playerPokemon->hasFainted) {
            $this->reportTeamPokemonFaintedCommand->run(
                $playerPokemon->id,
                $playerPokemon->level,
                $opponentPokemon->level,
            );
        }

        $this->playerRepository->savePlayer($player);
        $this->encounterRepository->save($encounter);

        $nextFirstPokemon = $round->playerFirst
            ? ($player->hasEntireTeamFainted() ? null : $player->getLeadPokemon())
            : null;
        $nextSecondPokemon = $round->playerFirst
            ? null
            : ($player->hasEntireTeamFainted() ? null : $player->getLeadPokemon());

        $events = array_merge(
            $this->eventFactory->createEncounterRoundEvents(
                $round->firstAttack,
                $round->firstPokemon,
                $round->secondPokemon,
                !$round->playerFirst,
                $nextSecondPokemon,
                $encounter->isLegendary,
            ),
            $this->eventFactory->createEncounterRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
                $encounter->isLegendary,
            ),
        );

        if ($player->hasEntireTeamFainted()) {
            $events[] = $this->eventFactory->createEncounterDefeatEvent($encounter);
        }

        echo json_encode($events);
    }
}
