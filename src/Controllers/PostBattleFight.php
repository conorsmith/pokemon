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

        $leadPokemonRow = $this->db->fetchAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL AND has_fainted = 0 ORDER BY team_position", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($leadPokemonRow === false) {
            $this->session->getFlashBag()->add("errors", "Your team has fainted.");
            header("Location: /battle/{$trainerBattleRow['id']}");
        }

        $challengedTrainer = null;

        foreach ($this->findLocation($instanceRow['current_location'])['trainers'] as $trainer) {
            if ($trainer['id'] === $trainerBattleRow['trainer_id']) {
                $challengedTrainer = $trainer;
            }
        }

        $activePokemonIndex = $trainerBattleRow['active_pokemon'];

        $activePokemonLevel = $challengedTrainer['team'][$activePokemonIndex]['level'];
        $leadPokemonLevel = $leadPokemonRow['level'];

        $hasWon = $this->calculateWinner($activePokemonLevel, $leadPokemonLevel);

        if ($hasWon) {

            $activePokemonName = $this->pokedex[$challengedTrainer['team'][$activePokemonIndex]['id']]['name'];

            $this->session->getFlashBag()->add("successes", "Enemy {$activePokemonName} fainted");

            if ($activePokemonIndex + 1 < count($challengedTrainer['team'])) {

                $this->db->update("trainer_battles", [
                    'active_pokemon' => $activePokemonIndex + 1,
                ], [
                    'id' => $trainerBattleRow['id'],
                ]);

                header("Location: /battle/{$trainerBattleRow['id']}");

            } else {

                $this->db->beginTransaction();

                $this->db->update("trainer_battles", [
                    'is_battling' => 0,
                ], [
                    'id' => $trainerBattleRow['id'],
                ]);

                $this->db->update("caught_pokemon", [
                    'has_fainted' => 0,
                ], [
                    'instance_id' => INSTANCE_ID,
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
        } else {

            $this->db->update("caught_pokemon", [
                'has_fainted' => 1,
            ], [
                'instance_id' => INSTANCE_ID,
                'id' => $leadPokemonRow['id'],
            ]);

            $teamRows = $this->db->fetchAllAssociative("SELECT * FROM caught_pokemon WHERE instance_id = :instanceId AND team_position IS NOT NULL", [
                'instanceId' => INSTANCE_ID,
            ]);

            $remainingPokemonCount = 0;

            foreach ($teamRows as $row) {
                if ($row['has_fainted'] === 0) {
                    $remainingPokemonCount++;
                }
            }

            $leadPokemonName = $this->pokedex[$leadPokemonRow['pokemon_id']]['name'];

            $this->session->getFlashBag()->add("successes", "Your {$leadPokemonName} fainted");

            if ($remainingPokemonCount > 0) {

                header("Location: /battle/{$trainerBattleRow['id']}");

            } else {

                $this->db->beginTransaction();

                $this->db->update("trainer_battles", [
                    'is_battling' => 0,
                ], [
                    'id' => $trainerBattleRow['id'],
                ]);

                $this->db->update("caught_pokemon", [
                    'has_fainted' => 0,
                ], [
                    'instance_id' => INSTANCE_ID,
                ]);

                $this->db->commit();

                $this->session->getFlashBag()->add("successes", "You were defeated by {$challengedTrainer['name']}");

                header("Location: /map/encounter");
            }

        }

    }

    private function calculateWinner(int $enemyLevel, int $playerLevel): bool
    {
        $levelDifference = $playerLevel - $enemyLevel;

        $percentageChance = match (true) {
            $levelDifference > 4 => 100,
            $levelDifference < -4 => 0,
            default => match ($levelDifference) {
                4 => 95,
                3 => 90,
                2 => 75,
                1 => 60,
                0 => 50,
                -1 => 40,
                -2 => 25,
                -3 => 10,
                -4 => 5,
            }
        };

        return mt_rand(1, 100) <= $percentageChance;
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