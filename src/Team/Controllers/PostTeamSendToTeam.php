<?php

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToTeam
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not in box.");
            return new RedirectResponse("/{$args['instanceId']}/team");
        }

        $team = $this->pokemonRepository->getTeam();

        if ($team->isFull()) {
            $this->session->getFlashBag()->add("errors", "Team is full.");
            return new RedirectResponse("/{$args['instanceId']}/team");
        }

        $team = $team->add($pokemon);

        $this->friendshipLog->sentToTeam($pokemon);

        $this->pokemonRepository->saveTeam($team);

        return new RedirectResponse("/{$args['instanceId']}/team");
    }
}
