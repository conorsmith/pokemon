<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Party\DayCare;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\Party;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartySendToBox
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly FriendshipEventLogRepository $friendshipLog,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $party = $this->pokemonRepository->getParty();
        $dayCare = $this->pokemonRepository->getDayCare();

        if ($party->contains($pokemonId)) {
            if ($party->count() === 1) {
                $this->notifyPlayerCommand->run(
                    Notification::transient("You can't send your only party member to Box.")
                );
                return new RedirectResponse("/{$args['instanceId']}/party");
            }

            $this->moveFromPartyToBox($pokemonId, $party);
        } elseif ($dayCare->hasAttendee($pokemonId)) {
            $this->moveFromDayCareToBox($pokemonId, $dayCare);
        } else {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
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
