<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostTeamSendToDayCare
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
            $this->session->getFlashBag()->add("errors", "Pokémon not found.");
            header("Location: /team");
            return;
        }

        $dayCare = $this->pokemonRepository->getDayCare();

        if ($dayCare->isFull()) {
            $this->session->getFlashBag()->add("errors", "Day Care is full.");
            header("Location: /team");
            return;
        }

        $dayCare = $dayCare->dropOff($pokemon);

        $this->friendshipLog->sentToDayCare($pokemon);

        $this->pokemonRepository->saveDayCare($dayCare);

        header("Location: /team");
    }
}
