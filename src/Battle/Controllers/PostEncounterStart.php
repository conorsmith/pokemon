<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostEncounterStart
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly BagRepository $bagRepository,
    ) {}

    public function __invoke(): void
    {
        $legendaryPokemonNumber = $_POST['legendary'] ?? null;

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $player = $this->playerRepository->findPlayer();
        $bag = $this->bagRepository->find();

        if (!$bag->hasAnyPokeBall()) {
            $this->session->getFlashBag()->add("errors", "No Poké Balls remaining.");
            header("Location: /map");
            exit;
        }

        $player = $player->reviveTeam();

        if ($legendaryPokemonNumber) {
            $encounter = $this->encounterRepository->generateLegendaryEncounter($legendaryPokemonNumber);
        } else {
            $encounter = $this->encounterRepository->generateWildEncounter(
                $instanceRow['current_location'],
                $_POST['encounterType'],
            );
        }

        $this->playerRepository->savePlayer($player);
        $this->encounterRepository->save($encounter);

        if ($encounter->isLegendary) {
            $bag = $bag->use(ItemId::CHALLENGE_TOKEN);
            $this->bagRepository->save($bag);
        }

        header("Location: /encounter/{$encounter->id}");
    }
}
