<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class TrainerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function findTrainer(string $id): Trainer
    {
        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id' => $id,
        ]);

        return $this->createTrainer($trainerBattleRow['trainer_id'], $trainerBattleRow['is_battling'] === 1);
    }

    public function findTrainerByTrainerId(string $trainerId): Trainer
    {
        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND trainer_id = :trainerId", [
            'instanceId' => $this->instanceId->value,
            'trainerId'  => $trainerId,
        ]);

        return $this->createTrainer(
            $trainerId,
            $trainerBattleRow === false ? false : $trainerBattleRow['is_battling'] === 1
        );
    }

    public function findTrainersInLocation(string $locationId): array
    {
        $config = $this->trainerConfigRepository->findTrainersInLocation($locationId);

        if (is_null($config)) {
            return [];
        }

        $trainers = [];

        foreach ($config as $entry) {

            if (array_key_exists('prerequisite', $entry)
                && array_key_exists('victory', $entry['prerequisite'])
            ) {
                $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($entry['prerequisite']['victory']);
                if (is_null($eliteFourChallenge)) {
                    continue;
                }
            }

            if (array_key_exists('prerequisite', $entry)
                && array_key_exists('champion', $entry['prerequisite'])
            ) {
                $leagueChampion = $this->leagueChampionRepository->find($entry['prerequisite']['champion']);
                if (!$leagueChampion->isPlayer()) {
                    continue;
                }
            }

            $trainers[] = $this->findTrainerByTrainerId($entry['id']);
        }

        return $trainers;
    }

    public function findTrainersInRegion(RegionId $regionId): array
    {
        $config = $this->trainerConfigRepository->findTrainersInRegion($regionId);

        $trainers = [];

        foreach ($config as $locationEntries) {
            foreach ($locationEntries as $entry) {

                if (array_key_exists('prerequisite', $entry)
                    && array_key_exists('victory', $entry['prerequisite'])
                ) {
                    $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($entry['prerequisite']['victory']);
                    if (is_null($eliteFourChallenge)) {
                        continue;
                    }
                }

                if (array_key_exists('prerequisite', $entry)
                    && array_key_exists('champion', $entry['prerequisite'])
                ) {
                    $leagueChampion = $this->leagueChampionRepository->find($entry['prerequisite']['champion']);
                    if (!$leagueChampion->isPlayer()) {
                        continue;
                    }
                }

                $trainers[] = $this->findTrainerByTrainerId($entry['id']);
            }
        }

        return $trainers;
    }

    private function createTrainer(string $trainerId, bool $isBattling): Trainer
    {
        $trainerConfig = $this->trainerConfigRepository->findTrainer($trainerId);
        
        $locationConfig = $this->locationConfigRepository->findLocation($trainerConfig['locationId']);
        $location = new Location($locationConfig['id'], $locationConfig['region']);

        $team = [];

        $trainerBattlePokemonRows = $this->db->fetchAllAssociative("SELECT * FROM trainer_battle_pokemon WHERE trainer_battle_id = :trainerBattleId ORDER BY team_order", [
            'trainerBattleId' => $trainerId,
        ]);

        if (count($trainerBattlePokemonRows) > 0
            && count($trainerBattlePokemonRows) !== count($trainerConfig['team'])
        ) {
            throw new RuntimeException("Persisted Pokémon doesn't match configuration for Battle ID '{$trainerId}'");
        }

        RandomNumberGenerator::setSeed(crc32($trainerId));

        foreach ($trainerConfig['team'] as $i => $pokemonConfig) {

            if ($trainerBattlePokemonRows === []) {
                $trainerBattlePokemonId = Uuid::uuid4()->toString();
            } else {
                $trainerBattlePokemonId = $trainerBattlePokemonRows[$i]['id'];
            }

            $level = $pokemonConfig['level'] + $location->calculateRegionalLevelOffset();

            $pokedexEntry = $this->findPokedexEntry($pokemonConfig['id']);
            $pokemon = new Pokemon(
                $trainerBattlePokemonId,
                $pokemonConfig['id'],
                $pokemonConfig['form'] ?? null,
                $pokedexEntry['type'][0],
                $pokedexEntry['type'][1] ?? null,
                $level,
                0,
                $pokemonConfig['sex'] ?? Sex::UNKNOWN,
                isset($pokemonConfig['isShiny']) && $pokemonConfig['isShiny'],
                self::createStats($trainerConfig['class'], $level, $pokemonConfig['id']),
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
                    'trainer_battle_id' => $trainerId,
                    'team_order' => $i,
                    'pokemon_number' => $pokemon->number,
                    'remaining_hp' => $pokemon->remainingHp,
                ]);
            }

            $team[] = $pokemon;
        }

        RandomNumberGenerator::unsetSeed();

        return new Trainer(
            $trainerId,
            $trainerConfig['name'] ?? null,
            $trainerConfig['class'],
            $trainerConfig['gender'] ?? Gender::IMMATERIAL,
            $team,
            $trainerConfig['locationId'],
            $isBattling,
            array_key_exists('leader', $trainerConfig) ? $trainerConfig['leader']['badge'] : null,
        );
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception("Given Pokémon Number '{$number}' does not exist in Pokédex");
        }

        return $this->pokedex[$number];
    }

    public function saveTrainer(Trainer $battleTrainer): void
    {
        $this->db->update("trainer_battles", [
            'is_battling' => $battleTrainer->isBattling ? "1" : "0",
            'active_pokemon' => 0,
        ], [
            'trainer_id' => $battleTrainer->id,
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

    private static function createStats(string $trainerClass, int $level, string $number): Stats
    {
        $baseStats = self::findBaseStats($number);

        return new Stats(
            $level,
            $baseStats['hp'],
            $baseStats['attack'],
            $baseStats['defence'],
            $baseStats['spAttack'],
            $baseStats['spDefence'],
            $baseStats['speed'],
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            0,
            0,
            0,
            0,
            0,
            0,
        );
    }

    private static function generateIv(string $trainerClass): int
    {
        $weightedDistribution = TrainerClass::getWeightedDistributionForIvs($trainerClass);

        if (is_null($weightedDistribution)) {
            return RandomNumberGenerator::generateInRange(0, 31);
        }

        return RandomNumberGenerator::generateFromWeightedTable($weightedDistribution);
    }

    private static function findBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}