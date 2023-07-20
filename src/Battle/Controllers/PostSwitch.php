<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostSwitch
{
    public function __construct(
        private readonly PlayerRepositoryDb $playerRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');
        $redirectUrl = $request->request->get('redirectUrl');

        $player = $this->playerRepository->findPlayer();

        $leadPokemon = $player->getLeadPokemon();
        $targetPokemon = $player->findTeamMember($pokemonId);

        $player = $player->switchTeamMembers($leadPokemon, $targetPokemon);

        $this->playerRepository->savePlayer($player);

        return new RedirectResponse($redirectUrl);
    }
}
