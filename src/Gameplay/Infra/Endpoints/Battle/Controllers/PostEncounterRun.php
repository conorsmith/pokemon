<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\EncounterRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
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

        $player = $player->reviveParty();

        $this->encounterRepository->delete($encounter);
        $this->playerRepository->savePlayer($player);

        return new RedirectResponse("/{$args['instanceId']}/map/pokemon");
    }
}
