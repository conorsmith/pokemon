<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPartySendToDayCare
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $dayCare = $this->pokemonRepository->getDayCare();

        if ($dayCare->isFull()) {
            $this->session->getFlashBag()->add("errors", "Day Care is full.");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $dayCare = $dayCare->dropOff($pokemon);

        $this->friendshipLog->sentToDayCare($pokemon);

        $this->pokemonRepository->saveDayCare($dayCare);

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}
