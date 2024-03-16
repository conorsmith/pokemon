<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Attack;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Encounter;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EncounterRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Round;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterFight
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
        private readonly FriendshipEventLogRepository $friendshipEventLogRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly EventFactory $eventFactory,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];
        $playerAttackInput = $request->request->get('attack');

        $encounter = $this->encounterRepository->find($encounterId);
        $player = $this->playerRepository->findPlayer();

        if (is_null($encounter)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Encounter not found")
            );
            return new RedirectResponse("/{$args['instanceId']}/map/pokemon");
        }

        if ($player->hasEntirePartyFainted()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Your party has fainted.")
            );
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
            if ($opponentPokemon->level - $playerPokemon->level >= 30) {
                $this->friendshipEventLogRepository->faintedToPowerfulOpponent($playerPokemon->id);
            } else {
                $this->friendshipEventLogRepository->fainted($playerPokemon->id);
            }
        }

        $doesStrengthIndicatorProgress = self::determineIfStrengthIndicatorProgresses($encounter);

        if ($doesStrengthIndicatorProgress) {
            $encounter = $encounter->strengthIndicatorProgresses();
        }

        $this->playerRepository->savePlayer($player);
        $this->encounterRepository->save($encounter);

        $nextFirstPokemon = $round->playerFirst
            ? ($player->hasEntirePartyFainted() ? null : $player->getLeadPokemon())
            : null;
        $nextSecondPokemon = $round->playerFirst
            ? null
            : ($player->hasEntirePartyFainted() ? null : $player->getLeadPokemon());

        $events = array_merge(
            $this->eventFactory->createEncounterRoundEvents(
                $round->firstAttack,
                $round->firstPokemon,
                $round->secondPokemon,
                !$round->playerFirst,
                $nextSecondPokemon,
            ),
            $this->eventFactory->createEncounterRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
            ),
        );

        if ($player->hasEntirePartyFainted()) {
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
