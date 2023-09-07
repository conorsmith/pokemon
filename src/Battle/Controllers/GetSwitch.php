<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetSwitch
{
    public function __construct(
        private readonly PlayerRepositoryDb $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $redirectUrl = $request->query->get('redirect');

        $player = $this->playerRepository->findPlayer();

        $partyViewModels = [];

        foreach ($player->party as $i => $pokemon) {
            $partyViewModels[] = $this->viewModelFactory->createPokemonInBattle($pokemon);
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Switch.php", [
            'party'       => $partyViewModels,
            'redirectUrl' => $redirectUrl,
        ]));
    }
}
