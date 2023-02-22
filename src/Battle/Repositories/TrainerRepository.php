<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
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

        $trainerBattlePokemonRows = $this->db->fetchAllAssociative("SELECT * FROM trainer_battle_pokemon WHERE trainer_battle_id = :trainerBattleId ORDER BY team_order", [
            'trainerBattleId' => $trainerBattleRow['id'],
        ]);

        foreach ($trainerConfig['team'] as $i => $pokemonConfig) {

            if ($trainerBattlePokemonRows === []) {
                $trainerBattlePokemonId = Uuid::uuid4()->toString();
            } else {
                $trainerBattlePokemonId = $trainerBattlePokemonRows[$i]['id'];
            }

            $pokedexEntry = $this->findPokedexEntry($pokemonConfig['id']);
            $pokemon = new Pokemon(
                $trainerBattlePokemonId,
                $pokemonConfig['id'],
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $pokemonConfig['level'],
                0,
                isset($pokemonConfig['isShiny']) && $pokemonConfig['isShiny'],
                self::createStats($pokemonConfig['id']),
                0,
                false,
            );

            if ($trainerBattlePokemonRows === []) {
                $pokemon->remainingHp = $pokemon->calculateHp();
            } else {
                $pokemon->remainingHp = $trainerBattlePokemonRows[$i]['remaining_hp'];
                $pokemon->hasFainted = $pokemon->remainingHp === 0;
            }

            if ($trainerBattlePokemonRows === []) {
                $this->db->insert("trainer_battle_pokemon", [
                    'id' => Uuid::uuid4(),
                    'trainer_battle_id' => $trainerBattleRow['id'],
                    'team_order' => $i,
                    'pokemon_number' => $pokemon->number,
                    'remaining_hp' => $pokemon->remainingHp,
                ]);
            }

            $team[] = $pokemon;
        }

        return new Trainer(
            $trainerBattleRow['id'],
            $trainerConfig['name'] ?? null,
            $trainerConfig['class'],
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
            array_key_exists('leader', $trainerConfig) ? $trainerConfig['leader']['badge'] : null,
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
        $trainerConfig = require __DIR__ . "/../../Config/Trainers.php";

        foreach ($trainerConfig as $trainers) {
            foreach ($trainers as $trainer) {
                if ($trainer['id'] === $id) {
                    return $trainer;
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
            'active_pokemon' => 0,
        ], [
            'id' => $battleTrainer->id,
        ]);

        if ($battleTrainer->isBattling) {
            /** @var Pokemon $pokemon */
            foreach ($battleTrainer->team as $pokemon) {
                $this->db->update("trainer_battle_pokemon", [
                    'remaining_hp' => $pokemon->remainingHp,
                ], [
                    'id' => $pokemon->id,
                ]);
            }
        } else {
            $this->db->delete("trainer_battle_pokemon", [
                'trainer_battle_id' => $battleTrainer->id,
            ]);
        }
    }

    private static function createStats(string $number): Stats
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return new Stats(
                    $entry['hp'],
                    $entry['attack'],
                    $entry['defence'],
                    $entry['spAttack'],
                    $entry['spDefence'],
                    $entry['speed'],
                );
            }
        }

        throw new Exception;
    }
}