<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToDayCare
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
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            return new RedirectResponse("/{$args['instanceId']}/team");
        }

        $dayCare = $this->pokemonRepository->getDayCare();

        if ($dayCare->isFull()) {
            $this->session->getFlashBag()->add("errors", "Day Care is full.");
            return new RedirectResponse("/{$args['instanceId']}/team");
        }

        $dayCare = $dayCare->dropOff($pokemon);

        $this->friendshipLog->sentToDayCare($pokemon);

        $this->pokemonRepository->saveDayCare($dayCare);

        return new RedirectResponse("/{$args['instanceId']}/team");
    }
}
