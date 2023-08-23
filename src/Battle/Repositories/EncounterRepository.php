<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\EncounterTableEntry;
use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use Exception;
use LogicException;
use Ramsey\Uuid\Uuid;
use RuntimeException;

final class EncounterRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly HabitStreakQuery $habitStreakQuery,
        private readonly InstanceId $instanceId,
    ) {}

    public function generateWildEncounter(Location $location, string $encounterType): Encounter
    {
        $encounterTable = $this->findEncounterTable(
            $location,
            $encounterType,
        );

        if (is_null($encounterTable)) {
            throw new Exception;
        }

        return $this->generate(
            self::randomlySelectEntry($encounterTable),
            false,
        );
    }

    public function generateLegendaryEncounter(string $number): Encounter
    {
        return $this->generate(
            new EncounterTableEntry(
                $number,
                null,
                1,
                self::findLegendaryPokemonLevel($number),
                self::findLegendaryPokemonLevel($number),
            ),
            true
        );
    }

    private function generate(EncounterTableEntry $encounterTableEntry, bool $isLegendary): Encounter
    {
        $sex = $this->generateEncounteredSex($encounterTableEntry->pokedexNumber);
        $isShiny = $this->generateEncounteredShininess();

        $encounterId = Uuid::uuid4()->toString();

        $pokedexEntry = $this->pokedexConfigRepository->find($encounterTableEntry->pokedexNumber);

        $level = $encounterTableEntry->generateLevel();

        $pokemon = new Pokemon(
            $encounterId,
            $encounterTableEntry->pokedexNumber,
            $encounterTableEntry->form,
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $level,
            0,
            $sex,
            $isShiny,
            self::generateStats($level, $encounterTableEntry->pokedexNumber),
            0,
            false,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number' => $pokemon->number,
        ]);

        return new Encounter(
            $encounterId,
            $pokemon,
            false,
            $isLegendary,
            $pokedexRow !== false,
            false,
            0
        );
    }

    public function find(string $id): ?Encounter
    {
        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id' => $id,
        ]);

        if ($encounterRow === false) {
            return null;
        }

        $pokedexEntry = $this->pokedexConfigRepository->find($encounterRow['pokemon_id']);

        $pokemon = new Pokemon(
            $id,
            $encounterRow['pokemon_id'],
            $encounterRow['form'],
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $encounterRow['level'],
            0,
            match ($encounterRow['sex']) {
                "F" => Sex::FEMALE,
                "M" => Sex::MALE,
                "U" => Sex::UNKNOWN,
                default => throw new RuntimeException(),
            },
            $encounterRow['is_shiny'] === 1,
            self::createStatsFromRow($encounterRow),
            $encounterRow['remaining_hp'],
            $encounterRow['remaining_hp'] === 0,
        );

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number' => $pokemon->number,
        ]);

        return new Encounter(
            $id,
            $pokemon,
            $encounterRow['has_started'] === 1 ? true : false,
            $encounterRow['is_legendary'] === 0 ? false : true,
            $pokedexRow !== false,
            $encounterRow['was_caught'] === 1 ? true : false,
            $encounterRow['strength_indicator_progress']
        );
    }

    public function save(Encounter $encounter): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :encounterId", [
            'instanceId' => $this->instanceId->value,
            'encounterId' => $encounter->id,
        ]);

        if ($row === false) {
            $this->db->insert("encounters", [
                'id' => $encounter->id,
                'instance_id' => $this->instanceId->value,
                'pokemon_id' => $encounter->pokemon->number,
                'form' => $encounter->pokemon->form,
                'level' => $encounter->pokemon->level,
                'sex' => match ($encounter->pokemon->sex) {
                    Sex::FEMALE => "F",
                    Sex::MALE => "M",
                    Sex::UNKNOWN => "U",
                },
                'is_shiny' => $encounter->pokemon->isShiny ? 1 : 0,
                'is_legendary' => $encounter->isLegendary ? 1 : 0,
                'iv_hp' => $encounter->pokemon->stats->ivHp,
                'iv_physical_attack' => $encounter->pokemon->stats->ivPhysicalAttack,
                'iv_physical_defence' => $encounter->pokemon->stats->ivPhysicalDefence,
                'iv_special_attack' => $encounter->pokemon->stats->ivSpecialAttack,
                'iv_special_defence' => $encounter->pokemon->stats->ivSpecialDefence,
                'iv_speed' => $encounter->pokemon->stats->ivSpeed,
                'remaining_hp' => $encounter->pokemon->remainingHp,
                'has_started' => $encounter->hasStarted ? 1 : 0,
                'was_caught' => 0,
                'strength_indicator_progress' => $encounter->strengthIndicatorProgress,
                'generated_at' => CarbonImmutable::now("Europe/Dublin")->format("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->update("encounters", [
                'remaining_hp' => $encounter->pokemon->remainingHp,
                'has_started' => $encounter->hasStarted ? 1 : 0,
                'was_caught' => $encounter->wasCaught ? 1 : 0,
                'strength_indicator_progress' => $encounter->strengthIndicatorProgress,
            ], [
                'id' => $encounter->id,
            ]);
        }
    }

    public function delete(Encounter $encounter): void
    {
        $this->db->delete("encounters", [
            'instance_id' => $this->instanceId->value,
            'id' => $encounter->id,
        ]);
    }

    public function deleteOldestEncountersOutsideLimit(): void
    {
        $limit = 10;

        $rows = $this->db->fetchAllAssociative("SELECT * FROM encounters WHERE has_started = 0 ORDER BY generated_at ASC", [
            'instance_id' => $this->instanceId->value,
        ]);

        $rowsToDelete = array_splice($rows, 0, $limit * -1);

        foreach ($rowsToDelete as $row) {
            $this->db->delete("encounters", [
                'instance_id' => $this->instanceId->value,
                'id' => $row['id'],
            ]);
        }
    }

    private static function generateStats(int $level, string $number): Stats
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
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            RandomNumberGenerator::generateInRange(0, 31),
            0,
            0,
            0,
            0,
            0,
            0,
        );
    }

    private static function createStatsFromRow(array $row): Stats
    {
        $baseStats = self::findBaseStats($row['pokemon_id']);

        return new Stats(
            $row['level'],
            $baseStats['hp'],
            $baseStats['attack'],
            $baseStats['defence'],
            $baseStats['spAttack'],
            $baseStats['spDefence'],
            $baseStats['speed'],
            $row['iv_hp'],
            $row['iv_physical_attack'],
            $row['iv_physical_defence'],
            $row['iv_special_attack'],
            $row['iv_special_defence'],
            $row['iv_speed'],
            0,
            0,
            0,
            0,
            0,
            0,
        );
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

    private function findLegendaryPokemonLevel(string $legendaryPokemonNumber): int
    {
        $legendaryConfig = self::findLegendaryConfig($legendaryPokemonNumber);

        if ($legendaryConfig['location'] instanceof RegionId) {
            $region = $legendaryConfig['location'];
        } else {
            $locationConfig = $this->locationConfigRepository->findLocation($legendaryConfig['location']);

            $region = $locationConfig['region'];
        }

        $regionalLevelOffset = match ($region) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
            default => throw new LogicException(),
        };

        return $legendaryConfig['level'] + $regionalLevelOffset;
    }

    private static function findLegendaryConfig(string $legendaryPokemonNumber): ?array
    {
        $legendariesConfig = require __DIR__ . "/../../Config/Legendaries.php";

        foreach ($legendariesConfig as $config) {
            if ($config['pokemon'] === $legendaryPokemonNumber) {
                return $config;
            }
        }

        return null;
    }

    private function findEncounterTable(Location $location, string $encounterType): ?array
    {
        $encountersConfig = $this->encounterConfigRepository->findEncounters($location->id);

        foreach ($encountersConfig as $key => $encounterTableConfig) {
            if ($key === $encounterType) {
                return self::createEncounterTableEntries($location, $encounterTableConfig);
            }
        }

        return null;
    }

    private static function createEncounterTableEntries(Location $location, array $encounterTableConfig): array
    {
        $entries = [];

        foreach ($encounterTableConfig as $pokedexNumber => $entryConfig) {
            if (array_key_exists('weight', $entryConfig)) {
                $entries[] = self::createEncounterTableEntry($location, strval($pokedexNumber), $entryConfig);
            } else {
                foreach ($entryConfig as $formEntryConfig) {
                    $entries[] = self::createEncounterTableEntry($location, strval($pokedexNumber), $formEntryConfig);
                }
            }
        }

        return $entries;
    }

    private static function createEncounterTableEntry(Location $location, string $pokedexNumber, array $entryConfig): EncounterTableEntry
    {
        return new EncounterTableEntry(
            $pokedexNumber,
            $entryConfig['form'] ?? null,
            $entryConfig['weight'],
            is_array($entryConfig['levels'])
                ? $entryConfig['levels'][0] + $location->calculateRegionalLevelOffset()
                : $entryConfig['levels'] + $location->calculateRegionalLevelOffset(),
            is_array($entryConfig['levels'])
                ? $entryConfig['levels'][1] + $location->calculateRegionalLevelOffset()
                : $entryConfig['levels'] + $location->calculateRegionalLevelOffset(),
        );
    }

    private static function randomlySelectEntry(array $encounterTable): EncounterTableEntry
    {
        $aggregatedWeight = array_reduce(
            $encounterTable,
            function ($carry, EncounterTableEntry $encounterTableEntry) {
                return $carry + $encounterTableEntry->weight;
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var EncounterTableEntry $encounterTableEntry */
        foreach ($encounterTable as $encounterTableEntry) {
            $randomlySelectedValue -= $encounterTableEntry->weight;
            if ($randomlySelectedValue <= 0) {
                return $encounterTableEntry;
            }
        }

        throw new Exception;
    }

    private function generateEncounteredSex(string $pokedexNumber): Sex
    {
        $pokedexConfig = $this->pokedexConfigRepository->find($pokedexNumber);

        if (count($pokedexConfig['sexRatio']) === 1) {
            return $pokedexConfig['sexRatio'][0]['sex'];
        }

        return self::randomlySelectSex($pokedexConfig['sexRatio']);
    }

    private static function randomlySelectSex(array $sexRatioConfig): Sex
    {
        $aggregatedWeight = array_reduce(
            $sexRatioConfig,
            function ($carry, array $sexRatioEntry) {
                return $carry + $sexRatioEntry['weight'];
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var array $sexRatioEntry */
        foreach ($sexRatioConfig as $sexRatioEntry) {
            $randomlySelectedValue -= $sexRatioEntry['weight'];
            if ($randomlySelectedValue <= 0) {
                return $sexRatioEntry['sex'];
            }
        }

        throw new Exception;
    }

    private function generateEncounteredShininess(): bool
    {
        $streak = $this->habitStreakQuery->run();

        $divisor = $streak < 7 ? self::curveBeforeOneWeek($streak) : self::curveAfterOneWeek($streak);

        $odds = intval(round(4096 / $divisor));

        return mt_rand(1, $odds) === 1;
    }

    private static function curveBeforeOneWeek(int $i): float
    {
        return 0.480898 * log(8 * ($i + 1));
    }

    private static function curveAfterOneWeek(int $i): float
    {
        return 3.54073 * log(0.251313 * $i);
    }
}
