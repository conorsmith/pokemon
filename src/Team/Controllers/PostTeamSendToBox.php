<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\DayCare;
use ConorSmith\Pokemon\Team\Domain\Team;
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
        $dayCare = $this->pokemonRepository->getDayCare();

        if ($team->contains($pokemonId)) {
            $this->moveFromTeamToBox($pokemonId, $team);
        } elseif ($dayCare->hasAttendee($pokemonId)) {
            $this->moveFromDayCareToBox($pokemonId, $dayCare);
        } else {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team");
            return;
        }

        header("Location: /team");
    }

    private function moveFromTeamToBox(string $pokemonId, Team $team): void
    {
        $boxedPokemon = $team->find($pokemonId);
        $team = $team->remove($pokemonId);

        $this->friendshipLog->sentToBox($boxedPokemon);

        $this->pokemonRepository->saveTeam($team);
        $this->pokemonRepository->savePokemon($boxedPokemon);
    }

    private function moveFromDayCareToBox(string $pokemonId, DayCare $dayCare): void
    {
        $attendingPokemon = $dayCare->find($pokemonId);
        $dayCare = $dayCare->pickUp($pokemonId);

        $this->friendshipLog->sentToBox($attendingPokemon);

        $this->pokemonRepository->saveDayCare($dayCare);
        $this->pokemonRepository->savePokemon($attendingPokemon);
    }
}
