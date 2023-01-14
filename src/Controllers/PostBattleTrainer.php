<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use Doctrine\DBAL\Connection;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostBattleTrainer
{
    public function __construct(
        private readonly Connection $db,
        private readonly Session $session,
        private readonly array $map,
    ) {}

    public function __invoke(array $args): void
    {
        $instanceRow = $this->db->fetchAssociative("SELECT * FROM instances WHERE id = :instanceId", [
            'instanceId' => INSTANCE_ID,
        ]);

        if ($instanceRow['unused_moves'] < 1) {
            $this->session->getFlashBag()->add("errors", "No unused battle tokens remaining.");
            header("Location: /map/encounter");
            exit;
        }

        $challengedTrainer = null;

        foreach ($this->findLocation($instanceRow['current_location'])['trainers'] as $trainer) {
            if ($trainer['id'] === $args['id']) {
                $challengedTrainer = $trainer;
            }
        }

        if (is_null($challengedTrainer)) {
            $this->session->getFlashBag()->add("errors", "Trainer not found");
            header("Location: /map/encounter");
            return;
        }

        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
            'instanceId' => INSTANCE_ID,
            'trainerId' => $challengedTrainer['id'],
        ]);

        $this->db->beginTransaction();

        if ($trainerBattleRow === false) {

            $battleId = Uuid::uuid4();

            $this->db->insert("trainer_battles", [
                'id' => $battleId,
                'instance_id' => INSTANCE_ID,
                'trainer_id' => $challengedTrainer['id'],
                'is_battling' => true,
                'date_last_battled' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
                'battle_count' => 1,
                'active_pokemon' => 0,
            ]);

        } else {

            $battleId = $trainerBattleRow['id'];

            $this->db->update("trainer_battles", [
                'is_battling' => true,
                'date_last_battled' => CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
                'battle_count' => $trainerBattleRow['battle_count'] + 1,
                'active_pokemon' => 0,
            ], [
                'id' => $trainerBattleRow['id'],
            ]);

        }

        $this->db->update("instances", [
            'unused_moves' => $instanceRow['unused_moves'] - 1,
        ], [
            'id' => INSTANCE_ID,
        ]);

        $this->db->commit();

        header("Location: /battle/{$battleId}");
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