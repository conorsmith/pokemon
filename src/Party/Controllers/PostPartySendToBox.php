<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\Domain\DayCare;
use ConorSmith\Pokemon\Party\Domain\Party;
use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPartySendToBox
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly FriendshipLog $friendshipLog,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();

        if ($party->contains($pokemonId)) {
            $this->moveFromPartyToBox($pokemonId, $party);
        } elseif ($dayCare->hasAttendee($pokemonId)) {
            $this->moveFromDayCareToBox($pokemonId, $dayCare);
        } else {
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        return new RedirectResponse("/{$args['instanceId']}/party");
    }

    private function moveFromPartyToBox(string $pokemonId, Party $party): void
    {
        $boxedPokemon = $party->find($pokemonId);
        $party = $party->remove($pokemonId);

        $this->friendshipLog->sentToBox($boxedPokemon);

        $this->pokemonRepository->saveParty($party);
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
