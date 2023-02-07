<?php

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToTeam
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function __invoke(): void
    {
        $pokemonId = $_POST['pokemon'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not in box.");
            header("Location: /team");
            return;
        }

        $team = $this->pokemonRepository->getTeam();

        if ($team->isFull()) {
            $this->session->getFlashBag()->add("errors", "Team is full.");
            header("Location: /team");
            return;
        }

        $team = $team->add($pokemon);

        $this->friendshipLog->sentToTeam($pokemon);

        $this->pokemonRepository->saveTeam($team);

        header("Location: /team");
    }
}
