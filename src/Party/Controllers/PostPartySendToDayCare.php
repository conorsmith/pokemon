<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartySendToDayCare
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
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $dayCare = $this->pokemonRepository->getDayCare();

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
