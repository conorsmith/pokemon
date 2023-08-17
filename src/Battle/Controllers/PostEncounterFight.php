<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\ReportTeamPokemonFaintedCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostEncounterFight
{
    public function __construct(
        private readonly Session $session,
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepositoryDb $playerRepository,
        private readonly EventFactory $eventFactory,
        private readonly ReportTeamPokemonFaintedCommand $reportTeamPokemonFaintedCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];
        $playerAttackInput = $request->request->get('attack');

        $encounter = $this->encounterRepository->find($encounterId);
        $player = $this->playerRepository->findPlayer();

        if (is_null($encounter)) {
            $this->session->getFlashBag()->add("errors", "Encounter not found");
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        if ($player->hasEntireTeamFainted()) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            return new RedirectResponse("/{$args['instanceId']}/encounter/{$encounter->id}");
        }

        $playerPokemon = $player->getLeadPokemon();
        $opponentPokemon = $encounter->pokemon;

        $playerAttack = new Attack(
            explode("-", $playerAttackInput)[0],
            explode("-", $playerAttackInput)[1],
        );

        $round = Round::execute(
            $playerPokemon,
            $opponentPokemon,
            $playerAttack,
            Attack::strongest($opponentPokemon),
        );

        if ($playerPokemon->hasFainted) {
            $this->reportTeamPokemonFaintedCommand->run(
                $playerPokemon->id,
                $playerPokemon->level,
                $opponentPokemon->level,
            );
        }

        $doesStrengthIndicatorProgress = self::determineIfStrengthIndicatorProgresses($encounter);

        if ($doesStrengthIndicatorProgress) {
            $encounter = $encounter->strengthIndicatorProgresses();
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

        if ($doesStrengthIndicatorProgress && !$opponentPokemon->hasFainted) {
            $events[] = $this->eventFactory->createStrengthIndicatorProgressesEvent($encounter);
        }

        return new JsonResponse($events);
    }

    private static function determineIfStrengthIndicatorProgresses(Encounter $encounter): bool
    {
        if (!$encounter->canStrengthIndicatorProgress()) {
            return false;
        }

        return RandomNumberGenerator::generateInRange(0, 3) === 0;
    }
}
