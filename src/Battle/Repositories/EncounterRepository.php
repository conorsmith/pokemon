<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\EncounterTableEntry;
use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class EncounterRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly array $pokedex,
        private readonly HabitStreakQuery $habitStreakQuery,
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
        $isShiny = $this->generateEncounteredShininess();

        $encounterId = Uuid::uuid4()->toString();

        $pokedexEntry = $this->pokedex[$encounterTableEntry->pokedexNumber];

        $pokemon = new Pokemon(
            $encounterId,
            $encounterTableEntry->pokedexNumber,
            $encounterTableEntry->form,
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $encounterTableEntry->generateLevel(),
            0,
            $isShiny,
            self::createStats($encounterTableEntry->pokedexNumber),
            0,
            false,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        return new Encounter(
            $encounterId,
            $pokemon,
            $isLegendary,
            false,
            false,
        );
    }

    public function find(string $id): ?Encounter
    {
        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => INSTANCE_ID,
            'id' => $id,
        ]);

        if ($encounterRow === false) {
            return null;
        }

        $pokedexEntry = $this->pokedex[$encounterRow['pokemon_id']];

        $pokemon = new Pokemon(
            $id,
            $encounterRow['pokemon_id'],
            $encounterRow['form'],
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $encounterRow['level'],
            0,
            $encounterRow['is_shiny'] === 1,
            self::createStats($encounterRow['pokemon_id']),
            $encounterRow['remaining_hp'],
            $encounterRow['remaining_hp'] === 0,
        );

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => INSTANCE_ID,
            'number' => $pokemon->number,
        ]);

        return new Encounter(
            $id,
            $pokemon,
            $encounterRow['is_legendary'] === 0 ? false : true,
            $pokedexRow !== false,
            $encounterRow['was_caught'] === 1 ? true : false,
        );
    }

    public function save(Encounter $encounter): void
    {
        $row = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :encounterId", [
            'instanceId' => INSTANCE_ID,
            'encounterId' => $encounter->id,
        ]);

        if ($row === false) {
            $this->db->insert("encounters", [
                'id' => $encounter->id,
                'instance_id' => INSTANCE_ID,
                'pokemon_id' => $encounter->pokemon->number,
                'form' => $encounter->pokemon->form,
                'level' => $encounter->pokemon->level,
                'is_shiny' => $encounter->pokemon->isShiny ? 1 : 0,
                'is_legendary' => $encounter->isLegendary ? 1 : 0,
                'remaining_hp' => $encounter->pokemon->remainingHp,
                'was_caught' => 0,
            ]);
        } else {
            $this->db->update("encounters", [
                'remaining_hp' => $encounter->pokemon->remainingHp,
                'was_caught' => $encounter->wasCaught ? 1 : 0,
            ], [
                'id' => $encounter->id,
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

    private function findLegendaryPokemonLevel(string $legendaryPokemonNumber): int
    {
        $legendaryConfig = self::findLegendaryConfig($legendaryPokemonNumber);

        return $legendaryConfig['level'];
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
