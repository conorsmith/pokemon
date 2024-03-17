<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartySendToDayCare
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipEventLogRepository $friendshipLog,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();

        if ($party->count() === 1) {
            $this->notifyPlayerCommand->run(
                Notification::transient("You can't send your only party member to Day Care.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        if ($dayCare->isFull()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Day Care is full.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $dayCare = $dayCare->dropOff($pokemon);

        $this->friendshipLog->sentToDayCare($pokemon);

        $this->pokemonRepository->saveDayCare($dayCare);

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}
