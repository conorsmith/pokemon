<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\StatsFactory;
use ConorSmith\Pokemon\Battle\Domain\StatsIv;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class TrainerRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly InstanceId $instanceId,
    ) {}

    public function findTrainer(string $id): Trainer
    {
        $trainerBattleRow = $this->db->fetchAssociative("SELECT * FROM trainer_battles WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id'         => $id,
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

    private function createTrainer(string $trainerId, bool $isBattling): Trainer
    {
        $trainerConfig = $this->trainerConfigRepository->findTrainer($trainerId);

        if (is_null($trainerConfig)) {

            $row = $this->db->fetchAssociative("
                SELECT *
                FROM generated_trainers
                WHERE id = :id
                  AND instance_id = :instanceId
                ", [
                    'id'         => $trainerId,
                    'instanceId' => $this->instanceId->value,
                ]
            );

            if ($row === false) {
                throw new Exception("Trainer not found for ID '{$trainerId}'");
            }

            $decodedParty = json_decode($row['party'], true);
            $party = [];

            RandomNumberGenerator::setSeed(crc32($trainerId));

            foreach ($decodedParty as $i => $decodedPokemon) {
                $battlePokemonRow = $this->db->fetchAssociative("SELECT * FROM trainer_battle_pokemon WHERE id = :id", [
                    'id' => $decodedPokemon['id'],
                ]);

                $pokedexEntry = $this->pokedexConfigRepository->find($decodedPokemon['pokedexNumber']);

                $pokemon = new Pokemon(
                    $decodedPokemon['id'],
                    $decodedPokemon['pokedexNumber'],
                    $decodedPokemon['form'],
                    $pokedexEntry['type'][0],
                    $pokedexEntry['type'][1] ?? null,
                    $decodedPokemon['level'],
                    $decodedPokemon['friendship'],
                    match($decodedPokemon['sex']) {
                        "F" => Sex::FEMALE,
                        "M" => Sex::MALE,
                        "U" => Sex::UNKNOWN,
                    },
                    $decodedPokemon['isShiny'],
                    StatsFactory::createStats(
                        $decodedPokemon['level'],
                        $pokedexEntry,
                        StatsFactory::generateIvsForTrainerClass($row['class'])
                    ),
                    0,
                    false,
                );

                if ($battlePokemonRow === false) {
                    $pokemon->remainingHp = $pokemon->calculateHp();
                } else {
                    $pokemon->remainingHp = $battlePokemonRow['remaining_hp'];
                    $pokemon->hasFainted = $pokemon->remainingHp === 0;
                }

                if ($battlePokemonRow === false) {
                    $this->db->insert("trainer_battle_pokemon", [
                        'id'                => $decodedPokemon['id'],
                        'trainer_battle_id' => $trainerId,
                        'party_order'       => $i,
                        'pokemon_number'    => $pokemon->number,
                        'remaining_hp'      => $pokemon->remainingHp,
                    ]);
                }

                $party[] = $pokemon;
            }

            RandomNumberGenerator::unsetSeed();

            return new Trainer(
                $trainerId,
                $row['name'],
                $row['class'],
                match ($row['gender']) {
                    "F" => Gender::FEMALE,
                    "I" => Gender::IMMATERIAL,
                    "M" => Gender::MALE,
                },
                $party,
                $row['location_id'],
                $isBattling,
                null,
            );

        } else {

            $locationConfig = $this->locationConfigRepository->findLocation($trainerConfig['locationId']);
            $location = new Location($locationConfig['id'], $locationConfig['region']);

            $party = [];

            $trainerBattlePokemonRows = $this->db->fetchAllAssociative("SELECT * FROM trainer_battle_pokemon WHERE trainer_battle_id = :trainerBattleId ORDER BY party_order", [
                'trainerBattleId' => $trainerId,
            ]);

            if (count($trainerBattlePokemonRows) > 0
                && count($trainerBattlePokemonRows) !== count($trainerConfig['party'])
            ) {
                throw new RuntimeException("Persisted Pokémon doesn't match configuration for Battle ID '{$trainerId}'");
            }

            RandomNumberGenerator::setSeed(crc32($trainerId));

            foreach ($trainerConfig['party'] as $i => $pokemonConfig) {

                if ($trainerBattlePokemonRows === []) {
                    $trainerBattlePokemonId = Uuid::uuid4()->toString();
                } else {
                    $trainerBattlePokemonId = $trainerBattlePokemonRows[$i]['id'];
                }

                $level = $pokemonConfig['level'] + $location->calculateRegionalLevelOffset();

                $pokedexEntry = $this->pokedexConfigRepository->find($pokemonConfig['id']);
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
                    StatsFactory::createStats(
                        $level,
                        $pokedexEntry,
                        StatsFactory::generateIvsForTrainerClass($trainerConfig['class'])
                    ),
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
                        'id'                => Uuid::uuid4(),
                        'trainer_battle_id' => $trainerId,
                        'party_order'       => $i,
                        'pokemon_number'    => $pokemon->number,
                        'remaining_hp'      => $pokemon->remainingHp,
                    ]);
                }

                $party[] = $pokemon;
            }

            RandomNumberGenerator::unsetSeed();

        }

        return new Trainer(
            $trainerId,
            $trainerConfig['name'] ?? null,
            $trainerConfig['class'],
            $trainerConfig['gender'] ?? Gender::IMMATERIAL,
            $party,
            $trainerConfig['locationId'],
            $isBattling,
            array_key_exists('leader', $trainerConfig) ? $trainerConfig['leader']['badge'] : null,
        );
    }

    public function saveTrainer(Trainer $battleTrainer): void
    {
        $trainerConfig = $this->trainerConfigRepository->findTrainer($battleTrainer->id);

        if (is_null($trainerConfig)) {
            $this->saveGeneratedTrainer($battleTrainer);
        }

        $this->db->update("trainer_battles", [
            'is_battling'    => $battleTrainer->isBattling ? "1" : "0",
            'active_pokemon' => 0,
        ], [
            'trainer_id' => $battleTrainer->id,
        ]);

        if ($battleTrainer->isBattling) {
            /** @var Pokemon $pokemon */
            foreach ($battleTrainer->party as $pokemon) {
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

    private function saveGeneratedTrainer(Trainer $trainer): void
    {
        $row = $this->db->fetchAssociative("
                SELECT *
                FROM generated_trainers
                WHERE id = :id
                  AND instance_id = :instanceId
                ", [
                'id'         => $trainer->id,
                'instanceId' => $this->instanceId->value,
            ]
        );

        if ($row === false) {
            $this->db->insert("generated_trainers", [
                'id'          => $trainer->id,
                'instance_id' => $this->instanceId->value,
                'name'        => $trainer->name,
                'class'       => $trainer->class,
                'gender'      => match ($trainer->gender) {
                    Gender::FEMALE     => "F",
                    Gender::IMMATERIAL => "I",
                    Gender::MALE       => "M",
                },
                'location_id' => $trainer->locationId,
                'party' => json_encode(array_map(
                    function (Pokemon $pokemon) {
                        return [
                            'id'            => $pokemon->id,
                            'pokedexNumber' => $pokemon->number,
                            'form'          => $pokemon->form,
                            'level'         => $pokemon->level,
                            'friendship'    => $pokemon->friendship,
                            'sex'           => match ($pokemon->sex) {
                                Sex::FEMALE  => "F",
                                Sex::MALE    => "M",
                                Sex::UNKNOWN => "U",
                            },
                            'isShiny'       => $pokemon->isShiny,
                        ];
                    },
                    $trainer->party,
                )),
            ]);
        } else {
            $this->db->update("generated_trainers", [
                'name'        => $trainer->name,
                'class'       => $trainer->class,
                'gender'      => match ($trainer->gender) {
                    Gender::FEMALE     => "F",
                    Gender::IMMATERIAL => "I",
                    Gender::MALE       => "M",
                },
                'location_id' => $trainer->locationId,
                'party' => json_encode(array_map(
                    function (Pokemon $pokemon) {
                        return [
                            'id'            => $pokemon->id,
                            'pokedexNumber' => $pokemon->number,
                            'form'          => $pokemon->form,
                            'level'         => $pokemon->level,
                            'friendship'    => $pokemon->friendship,
                            'sex'           => match ($pokemon->sex) {
                                Sex::FEMALE  => "F",
                                Sex::MALE    => "M",
                                Sex::UNKNOWN => "U",
                            },
                            'isShiny'       => $pokemon->isShiny,
                        ];
                    },
                    $trainer->party,
                )),
            ], [
                'id'          => $trainer->id,
                'instance_id' => $this->instanceId->value,
            ]);
        }
    }
}
