<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');
        $redirectUrl = $request->request->get('redirectUrl');

        $player = $this->playerRepository->findPlayer();

        $leadPokemon = $player->getLeadPokemon();
        $targetPokemon = $player->findPartyMember($pokemonId);

        $player = $player->switchPartyMembers($leadPokemon, $targetPokemon);

        $this->playerRepository->savePlayer($player);

        return new RedirectResponse($redirectUrl);
    }
}
