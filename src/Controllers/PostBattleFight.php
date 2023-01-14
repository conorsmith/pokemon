<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\ViewModels\TeamMember;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleFight
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function __invoke(array $args): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $args['id'],
        ]);

        $challengedTrainer = null;

        foreach ($this->findLocation($instanceRow['current_location'])['trainers'] as $trainer) {
            if ($trainer['id'] === $trainerBattleRow['trainer_id']) {
                $challengedTrainer = $trainer;
            }
        }

        $activePokemonIndex = $trainerBattleRow['active_pokemon'];

        $activePokemonName = $this->pokedex[$challengedTrainer['team'][$activePokemonIndex]['id']]['name'];

        if ($activePokemonIndex + 1 < count($challengedTrainer['team'])) {

            $this->db->update("trainer_battles", [
                'active_pokemon' => $activePokemonIndex + 1,
            ], [
                'id' => $trainerBattleRow['id'],
            ]);

            $this->session->getFlashBag()->add("successes", "Enemy {$activePokemonName} fainted");

            header("Location: /battle/{$trainerBattleRow['id']}");

        } else {

            $this->db->beginTransaction();

            $this->db->update("trainer_battles", [
                'is_battling' => 0,
            ], [
                'id' => $trainerBattleRow['id'],
            ]);

            $this->db->update("instances", [
                'money' => $instanceRow['money'] + $challengedTrainer['prize'],
            ], [
                'id' => INSTANCE_ID,
            ]);

            $this->db->commit();

            $this->session->getFlashBag()->add("successes", "You defeated {$challengedTrainer['name']}");
            $this->session->getFlashBag()->add("successes", "You won \${$challengedTrainer['prize']}");

            header("Location: /map/encounter");
        }

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