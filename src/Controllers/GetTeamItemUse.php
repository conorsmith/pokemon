<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Player;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetTeamItemUse
{
    public function __construct(
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $itemId = $args['id'];

        $bag = $this->bagRepository->find();

        $player = $this->playerRepository->findPlayer();

        $itemConfig = require __DIR__ . "/../Config/Items.php";

        if ($bag->count($itemId) < 1) {
            $this->session->getFlashBag()->add("successes", "You have no more {$itemConfig[$itemId]['name']}");
            return new RedirectResponse("/{$args['instanceId']}/bag");
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/TeamUse.php", [
            'item' => (object) [
                'id' => $itemId,
                'name' => $itemConfig[$itemId]['name'],
                'imageUrl' => $itemConfig[$itemId]['imageUrl'],
            ],
            'team' => $this->createTeamViewModels($player),
        ]));
    }

    private function createTeamViewModels(Player $player): array
    {
        $viewModels = [];

        foreach ($player->team as $pokemon) {
            $viewModels[] = $this->viewModelFactory->createPokemonOnTeam($pokemon);
        }

        return $viewModels;
    }
}
