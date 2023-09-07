<?php

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPartySendToParty
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
            $this->session->getFlashBag()->add("errors", "Pokémon not in box.");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $party = $this->pokemonRepository->getParty();

        if ($party->isFull()) {
            $this->session->getFlashBag()->add("errors", "Party is full.");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $party = $party->add($pokemon);

        $this->friendshipLog->sentToParty($pokemon);

        $this->pokemonRepository->saveParty($party);

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}
