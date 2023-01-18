<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Repositories\Battle;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Domain\Battle\Trainer;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class TrainerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
        private readonly array $map,
    ) {}

    public function findTrainer(string $id): Trainer
    {
        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        return $this->createTrainer($trainerBattleRow);
    }

    public function findTrainerByTrainerId(string $trainerId): Trainer
    {
        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
            'instanceId' => INSTANCE_ID,
            'trainerId' => $trainerId,
        ]);

        if ($trainerBattleRow === false) {
            $this->db->insert("trainer_battles", [
                'id' => Uuid::uuid4(),
                'instance_id' => INSTANCE_ID,
                'trainer_id' => $trainerId,
                'is_battling' => 0,
                'date_last_beaten' => null,
                'battle_count' => 0,
                'active_pokemon' => 0,
            ]);

            $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
                'instanceId' => INSTANCE_ID,
                'trainerId' => $trainerId,
            ]);
        }

        return $this->createTrainer($trainerBattleRow);
    }

    private function createTrainer(array $trainerBattleRow): Trainer
    {
        $trainerConfig = $this->findTrainerConfig($trainerBattleRow['trainer_id']);

        $team = [];

        foreach ($trainerConfig['team'] as $i => $pokemonConfig) {
            $pokedexEntry = $this->findPokedexEntry($pokemonConfig['id']);
            $team[] = new Pokemon(
                $pokemonConfig['id'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $pokemonConfig['level'],
                $i < $trainerBattleRow['active_pokemon'],
            );
        }

        return new Trainer(
            $trainerBattleRow['id'],
            $trainerConfig['name'],
            $trainerConfig['prize'],
            $team,
            $trainerBattleRow['is_battling'] === 1,
            is_null($trainerBattleRow['date_last_beaten'])
                ? null
                : CarbonImmutable::createFromFormat(
                "Y-m-d H:i:s",
                $trainerBattleRow['date_last_beaten'],
                new CarbonTimeZone("Europe/Dublin")
            ),
            $trainerBattleRow['battle_count'],
        );
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception;
        }

        return $this->pokedex[$number];
    }

    private function findTrainerConfig(string $id): array
    {
        foreach ($this->map as $location) {
            if (array_key_exists('trainers', $location)) {
                foreach ($location['trainers'] as $trainer) {
                    if ($trainer['id'] === $id) {
                        return $trainer;
                    }
                }
            }
        }

        throw new Exception;
    }

    public function saveTrainer(Trainer $battleTrainer): void
    {
        $this->db->update("trainer_battles", [
            'is_battling' => $battleTrainer->isBattling ? "1" : "0",
            'date_last_beaten' => $battleTrainer->dateLastBeaten,
            'battle_count' => $battleTrainer->battleCount,
            'active_pokemon' => $battleTrainer->countFaintedTeamMembers(),
        ], [
            'id' => $battleTrainer->id,
        ]);
    }
}