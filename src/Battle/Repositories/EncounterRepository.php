<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\SharedKernel\HabitStreakQuery;
use Doctrine\DBAL\Connection;
use Exception;
use Ramsey\Uuid\Uuid;

final class EncounterRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly array $pokedex,
        private readonly array $map,
        private readonly HabitStreakQuery $habitStreakQuery,
    ) {}

    public function generateWildEncounter(string $locationId, string $encounterType): Encounter
    {
        $encounterTable = $this->findEncounterTable(
            $locationId,
            $encounterType,
        );

        if (is_null($encounterTable)) {
            throw new Exception;
        }

        $number = self::generateEncounteredPokemon($encounterTable);
        $level = self::generateEncounteredLevel($encounterTable, $number);

        return $this->generate($number, $level);
    }

    public function generateLegendaryEncounter(string $number): Encounter
    {
        return $this->generate($number, self::findLegendaryPokemonLevel($number));
    }

    private function generate(string $number, int $level): Encounter
    {
        $isShiny = $this->generateEncounteredShininess();

        $encounterId = Uuid::uuid4()->toString();

        $pokedexEntry = $this->pokedex[$number];

        $pokemon = new Pokemon(
            $encounterId,
            $number,
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $level,
            0,
            $isShiny,
            self::createStats($number),
            0,
            false,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        return new Encounter(
            $encounterId,
            $pokemon,
            false,
            false
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
                'level' => $encounter->pokemon->level,
                'is_shiny' => $encounter->pokemon->isShiny ? 1 : 0,
                'is_legendary' => $encounter->isLegendary ? 1 : 0,
                'remaining_hp' => $encounter->pokemon->remainingHp,
            ]);
        } else {
            $this->db->update("encounters", [
                'remaining_hp' => $encounter->pokemon->remainingHp,
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

    private function findEncounterTable(string $locationId, string $encounterType): ?array
    {
        $locationConfig = $this->findLocation($locationId);

        if (!isset($locationConfig['pokemon'])) {
            return null;
        }

        foreach ($locationConfig['pokemon'] as $key => $value) {
            if ($key === $encounterType) {
                return $value;
            }
        }

        return $locationConfig['pokemon'];
    }

    private function findLocation(string $id): array
    {
        /** @var array $location */
        foreach ($this->map as $location) {
            if ($location['id'] === $id) {
                return $location;
            }
        }

        throw new Exception;
    }

    private static function generateEncounteredPokemon(array $encounterTable): string
    {
        $selectedValue = mt_rand(1, array_reduce($encounterTable, function ($carry, array $encounterData) {
            return $carry + $encounterData['weight'];
        }, 0));

        foreach ($encounterTable as $pokemonId => $encounterData) {
            $selectedValue -= $encounterData['weight'];
            if ($selectedValue <= 0) {
                return strval($pokemonId);
            }
        }

        throw new Exception;
    }

    private static function generateEncounteredLevel(array $encounterTable, string $pokemonId): int
    {
        $levels = $encounterTable[$pokemonId]['levels'];

        if (is_int($levels)) {
            return $levels;
        }

        return mt_rand($levels[0], $levels[1]);
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
