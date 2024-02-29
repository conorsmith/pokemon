<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Battle\Domain\Encounter;
use ConorSmith\Pokemon\Battle\Domain\EncounterTableEntry;
use ConorSmith\Pokemon\Battle\Domain\Location;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\StatsFactory;
use ConorSmith\Pokemon\Battle\Domain\StatsIv;
use ConorSmith\Pokemon\SharedKernel\Queries\FixedEncounterQuery;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Queries\HabitStreakQuery;
use Doctrine\DBAL\Connection;
use Exception;
use LogicException;
use Ramsey\Uuid\Uuid;
use RuntimeException;

final class EncounterRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly FixedEncounterQuery $fixedEncounterQuery,
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

    public function generateFixedEncounter(Location $location, string $number): Encounter
    {
        $encounter = $this->fixedEncounterQuery->run($location->id, $number);

        if (is_null($encounter)) {
            throw new LogicException("Case where fixed encounter doesn't exist is unhandled");
        }

        if ($encounter->canBattle === false) {
            throw new LogicException("Case where player can't battle pokemon is unhandled");
        }

        return $this->generate(
            new EncounterTableEntry(
                $encounter->pokedexNumber,
                $encounter->form,
                1,
                $encounter->level,
                $encounter->level,
            ),
            true
        );
    }

    private function generate(EncounterTableEntry $encounterTableEntry, bool $isFixedEncounter): Encounter
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
            StatsFactory::createStats(
                $level,
                $pokedexEntry,
                StatsFactory::generateIvsForEncounteredPokemon()
            ),
            0,
            false,
            null,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number'     => $pokemon->number,
        ]);

        return new Encounter(
            $encounterId,
            $pokemon,
            false,
            $isFixedEncounter,
            $pokedexRow !== false,
            false,
            0
        );
    }

    public function find(string $id): ?Encounter
    {
        $encounterRow = $this->db->fetchAssociative("SELECT * FROM encounters WHERE instance_id = :instanceId AND id = :id", [
            'instanceId' => $this->instanceId->value,
            'id'         => $id,
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
                "F"     => Sex::FEMALE,
                "M"     => Sex::MALE,
                "U"     => Sex::UNKNOWN,
                default => throw new RuntimeException(),
            },
            $encounterRow['is_shiny'] === 1,
            StatsFactory::createStats(
                $encounterRow['level'],
                $pokedexEntry,
                new StatsIv(
                    $encounterRow['iv_hp'],
                    $encounterRow['iv_physical_attack'],
                    $encounterRow['iv_physical_defence'],
                    $encounterRow['iv_special_attack'],
                    $encounterRow['iv_special_defence'],
                    $encounterRow['iv_speed'],
                )
            ),
            $encounterRow['remaining_hp'],
            $encounterRow['remaining_hp'] === 0,
            null,
        );

        $pokedexRow = $this->db->fetchAssociative("SELECT * FROM pokedex_entries WHERE instance_id = :instanceId AND number = :number", [
            'instanceId' => $this->instanceId->value,
            'number'     => $pokemon->number,
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
            'instanceId'  => $this->instanceId->value,
            'encounterId' => $encounter->id,
        ]);

        if ($row === false) {
            $this->db->insert("encounters", [
                'id'                          => $encounter->id,
                'instance_id'                 => $this->instanceId->value,
                'pokemon_id'                  => $encounter->pokemon->number,
                'form'                        => $encounter->pokemon->form,
                'level'                       => $encounter->pokemon->level,
                'sex'                         => match ($encounter->pokemon->sex) {
                    Sex::FEMALE  => "F",
                    Sex::MALE    => "M",
                    Sex::UNKNOWN => "U",
                },
                'is_shiny'                    => $encounter->pokemon->isShiny ? 1 : 0,
                'is_legendary'                => $encounter->isFixed ? 1 : 0,
                'iv_hp'                       => $encounter->pokemon->stats->ivs->hp,
                'iv_physical_attack'          => $encounter->pokemon->stats->ivs->physicalAttack,
                'iv_physical_defence'         => $encounter->pokemon->stats->ivs->physicalDefence,
                'iv_special_attack'           => $encounter->pokemon->stats->ivs->specialAttack,
                'iv_special_defence'          => $encounter->pokemon->stats->ivs->specialDefence,
                'iv_speed'                    => $encounter->pokemon->stats->ivs->speed,
                'remaining_hp'                => $encounter->pokemon->remainingHp,
                'has_started'                 => $encounter->hasStarted ? 1 : 0,
                'was_caught'                  => 0,
                'strength_indicator_progress' => $encounter->strengthIndicatorProgress,
                'generated_at'                => CarbonImmutable::now("Europe/Dublin")->format("Y-m-d H:i:s"),
            ]);
        } else {
            $this->db->update("encounters", [
                'remaining_hp'                => $encounter->pokemon->remainingHp,
                'has_started'                 => $encounter->hasStarted ? 1 : 0,
                'was_caught'                  => $encounter->wasCaught ? 1 : 0,
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
            'id'          => $encounter->id,
        ]);
    }

    public function deleteOldestEncountersOutsideLimit(): void
    {
        $limit = 10;

        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM encounters
            WHERE instance_id = :instanceId
                AND has_started = 0
            ORDER BY generated_at ASC
        ", [
            'instanceId' => $this->instanceId->value,
        ]);

        $rowsToDelete = array_splice($rows, 0, $limit * -1);

        foreach ($rowsToDelete as $row) {
            $this->db->delete("encounters", [
                'instance_id' => $this->instanceId->value,
                'id'          => $row['id'],
            ]);
        }
    }

    private function findEncounterTable(Location $location, string $encounterType): ?array
    {
        $encountersConfig = $this->wildEncounterConfigRepository->findWildEncounters($location->id);

        if (!$encountersConfig->hasTable($encounterType)) {
            return null;
        }

        $entries = [];

        foreach ($encountersConfig->getTable($encounterType)->entries as $entryConfig) {
            $entries[] = new EncounterTableEntry(
                $entryConfig->pokedexNumber,
                $entryConfig->form,
                $entryConfig->weight,
                $entryConfig->levelsLowerBound + $location->calculateRegionalLevelOffset(),
                $entryConfig->levelsUpperBound + $location->calculateRegionalLevelOffset(),
            );
        }

        return $entries;
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
