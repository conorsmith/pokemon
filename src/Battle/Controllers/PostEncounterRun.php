<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterRun
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepository $playerRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterId = $args['id'];

        $encounter = $this->encounterRepository->find($encounterId);
        $player = $this->playerRepository->findPlayer();

        $player = $player->reviveTeam();

        $this->encounterRepository->delete($encounter);
        $this->playerRepository->savePlayer($player);

        return new RedirectResponse("/{$args['instanceId']}/map");
    }
}
