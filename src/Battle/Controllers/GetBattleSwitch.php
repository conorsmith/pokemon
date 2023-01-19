<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;

final class GetBattleSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
    ) {}

    public function __invoke(array $args): void
    {
        $trainerBattleId = $args['id'];

        $player = $this->playerRepository->findPlayer();

        $teamViewModels = [];

        foreach ($player->team as $i => $pokemon) {
            $teamViewModels[] = $this->viewModelFactory->createPokemonInBattle($pokemon);
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/Switch.php", [
            'id' => $trainerBattleId,
            'team' => $teamViewModels,
        ]);
    }
}
