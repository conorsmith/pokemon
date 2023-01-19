<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;

final class PostBattleSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerId = $args['id'];
        $pokemonId = $_POST['pokemon'];

        $player = $this->playerRepository->findPlayer();

        $leadPokemon = $player->getLeadPokemon();
        $targetPokemon = $player->findTeamMember($pokemonId);

        $player = $player->switchTeamMembers($leadPokemon, $targetPokemon);

        $this->playerRepository->savePlayer($player);

        header("Location: /battle/{$trainerId}");
    }
}
