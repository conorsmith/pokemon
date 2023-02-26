<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;

final class PostSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $pokemonId = $_POST['pokemon'];
        $redirectUrl = $_POST['redirectUrl'];

        $player = $this->playerRepository->findPlayer();

        $leadPokemon = $player->getLeadPokemon();
        $targetPokemon = $player->findTeamMember($pokemonId);

        $player = $player->switchTeamMembers($leadPokemon, $targetPokemon);

        $this->playerRepository->savePlayer($player);

        header("Location: {$redirectUrl}");
    }
}
