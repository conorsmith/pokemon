<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToBox
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function __invoke(): void
    {
        $pokemonId = $_POST['pokemon'];

        $team = $this->pokemonRepository->getTeam();

        if (!$team->contains($pokemonId)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not on team.");
            header("Location: /team");
            return;
        }

        $boxedPokemon = $team->find($pokemonId);
        $team = $team->remove($pokemonId);

        $this->friendshipLog->sentToBox($boxedPokemon);

        $this->pokemonRepository->saveTeam($team);
        $this->pokemonRepository->savePokemon($boxedPokemon);

        header("Location: /team");
    }
}
