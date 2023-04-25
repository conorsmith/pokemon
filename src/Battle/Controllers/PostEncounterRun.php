<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;

final class PostEncounterRun
{
    public function __construct(
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepository $playerRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterId = $args['id'];

        $encounter = $this->encounterRepository->find($encounterId);
        $player = $this->playerRepository->findPlayer();

        $player = $player->reviveTeam();

        $this->encounterRepository->delete($encounter);
        $this->playerRepository->savePlayer($player);

        header("Location: /map");
    }
}
