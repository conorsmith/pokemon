<?php

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartySendToParty
{
    public function __construct(
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not in box.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $party = $this->pokemonRepository->getParty();

        if ($party->isFull()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Party is full.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $party = $party->add($pokemon);

        $this->friendshipLog->sentToParty($pokemon);

        $this->pokemonRepository->saveParty($party);

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}
