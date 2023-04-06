<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;

final class GetSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $redirectUrl = $_GET['redirect'];

        $player = $this->playerRepository->findPlayer();

        $teamViewModels = [];

        foreach ($player->team as $i => $pokemon) {
            $teamViewModels[] = $this->viewModelFactory->createPokemonInBattle($pokemon);
        }

        echo $this->templateEngine->render(__DIR__ . "/../Templates/Switch.php", [
            'team' => $teamViewModels,
            'redirectUrl' => $redirectUrl,
        ]);
    }
}
