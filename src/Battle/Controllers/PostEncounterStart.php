<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Doctrine\DBAL\Connection;

final class PostEncounterStart
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterRepository $encounterRepository,
        private readonly PlayerRepository $playerRepository,
        private readonly BagRepository $bagRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function __invoke(): void
    {
        $legendaryPokemonNumber = $_POST['legendary'] ?? null;

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $player = $this->playerRepository->findPlayer();
        $bag = $this->bagRepository->find();

        $player = $player->reviveTeam();

        if ($legendaryPokemonNumber) {
            $encounter = $this->encounterRepository->generateLegendaryEncounter($legendaryPokemonNumber);
        } else {
            $encounter = $this->encounterRepository->generateWildEncounter(
                $this->findLocation($instanceRow['current_location']),
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

    private function findLocation(string $locationId): Location
    {
        $config = $this->locationConfigRepository->findLocation($locationId);

        return new Location(
            $locationId,
            $config['region'],
        );
    }
}
