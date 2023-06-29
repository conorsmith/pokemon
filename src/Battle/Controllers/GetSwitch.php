<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetSwitch
{
    public function __construct(
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $redirectUrl = $request->query->get('redirect');

        $player = $this->playerRepository->findPlayer();

        $teamViewModels = [];

        foreach ($player->team as $i => $pokemon) {
            $teamViewModels[] = $this->viewModelFactory->createPokemonInBattle($pokemon);
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Switch.php", [
            'team' => $teamViewModels,
            'redirectUrl' => $redirectUrl,
        ]));
    }
}
