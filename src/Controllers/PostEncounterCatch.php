<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostEncounterCatch
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function __invoke(): void
    {
        $id = substr(substr($_SERVER['REQUEST_URI'], strlen("/encounter/")), 0, -strlen("/catch"));

        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_encounters'] < 1) {
            $this->session->getFlashBag()->add("errors", "No Poké Balls remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $pokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position = 1", [
            'instanceId' => INSTANCE_ID,
        ]);

        $levelDifference = $encounterRow['level'] - $pokemonRow['level'];

        if ($levelDifference > 5) {
            $chance = 0;
        } elseif ($levelDifference < -4) {
            $chance = 100;
        } else {
            switch ($levelDifference) {
                case 5:
                    $chance = 1;
                    break;
                case 4:
                    $chance = 8;
                    break;
                case 3:
                    $chance = 20;
                    break;
                case 2:
                    $chance = 50;
                    break;
                case 1:
                    $chance = 75;
                    break;
                case 0:
                    $chance = 90;
                    break;
                case -1:
                    $chance = 94;
                    break;
                case -2:
                    $chance = 96;
                    break;
                case -3:
                    $chance = 98;
                    break;
                case -4:
                    $chance = 99;
                    break;
            }
        }

        $caught = $chance >= mt_rand(1, 100);

        $pokemon = $this->pokedex[$encounterRow['pokemon_id']];

        if ($caught) {

            $this->session->getFlashBag()->add("successes", "You caught the wild {$pokemon['name']}!");

            $positionRow = $this->db->fetchNumeric("SELECT MAX(team_position) FROM caught_pokemon WHERE instance_id = :instanceId", [
                'instanceId' => INSTANCE_ID,
            ]);

            if ($positionRow[0] >= 6) {
                $teamPosition = null;
                $this->session->getFlashBag()->add("successes", "{$pokemon['name']} was sent to your box");
            } else {
                $teamPosition = $positionRow[0] + 1;
            }

            $currentLocation = $this->findLocation($instanceRow['current_location']);

            $this->db->insert("caught_pokemon", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'pokemon_id' => $encounterRow['pokemon_id'],
                'level' => $encounterRow['level'],
                'team_position' => $teamPosition,
                'has_fainted' => 0,
                'location_caught' => $currentLocation['id'],
                'date_caught' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            ]);
        } else {
            $this->session->getFlashBag()->add("successes", "You failed to catch the wild {$pokemon['name']}");
        }

        $this->db->update("instances", [
            'unused_encounters' => $instanceRow['unused_encounters'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->delete("encounters", [
            'instance_id' => INSTANCE_ID,
            'id' => $id,
        ]);

        header("Location: /map/encounter");
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new \Exception;
    }
}