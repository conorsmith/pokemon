<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\BulbapediaEncounter;
use ConorSmith\Pokemon\Import\Domain\EncounterTable;
use ConorSmith\Pokemon\Import\Domain\EncounterTableEntry;
use ConorSmith\Pokemon\Import\Domain\EncounterType;
use ConorSmith\Pokemon\Import\Domain\LevelRange;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\EncounterType as EncounterTypeConstants;
use ConorSmith\Pokemon\PokedexNo;
use Exception;
use ReflectionClass;

final class EncounterTableFactory
{
    public function createEncounterTablesFromBulbapediaEncounters(array $bulbapediaEncounters): array
    {
        $encounterTables = [];

        /** @var BulbapediaEncounter $encounter */
        foreach ($bulbapediaEncounters as $encounter) {
            $encounterType = $this->createEncounterType($encounter->type);

            if ($encounterType->isIrrelevant()) {
                continue;
            }

            if (!array_key_exists($encounterType->value, $encounterTables)) {
                $encounterTables[$encounterType->value] = new EncounterTable(
                    $encounterType,
                    [],
                );
            }

            $encounterTableEntry = new EncounterTableEntry(
                $this->createPokedexNumberFromPokemonName($encounter->name),
                intval($encounter->rate),
                $this->createLevelRange($encounter->levels),
            );

            $encounterTables[$encounterType->value] = $encounterTables[$encounterType->value]->add($encounterTableEntry);
        }

        return $encounterTables;
    }

    private function createEncounterType(string $value): EncounterType
    {
        if ($value === "Grass") {
            return new EncounterType(EncounterTypeConstants::WALKING);
        }

        if ($value === "Surfing") {
            return new EncounterType(EncounterTypeConstants::SURFING);
        }

        if (substr($value, 0, 7) === "Fishing") {
            return new EncounterType(EncounterTypeConstants::FISHING);
        }

        if ($value === "Only one") {
            return EncounterType::irrelevant();
        }

        throw new Exception;
    }

    private function createPokedexNumberFromPokemonName(string $name): PokedexNumber
    {
        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);

        return new PokedexNumber(
            $pokedexNoReflector->getConstants()[strtoupper($name)],
        );
    }

    private function createLevelRange(string $levels): LevelRange
    {
        if (strpos($levels, ",") !== false) {
            $listedLevels = array_map(fn($level) => intval(trim($level)), explode(",", $levels));
            sort($listedLevels);
            return new LevelRange(
                intval($listedLevels[0]),
                intval($listedLevels[count($listedLevels) - 1]),
            );
        }

        if (strpos($levels, "-") !== false) {
            $levelRange = explode("-", $levels);
            return new LevelRange(
                intval($levelRange[0]),
                intval($levelRange[1]),
            );
        }

        return new LevelRange(intval($levels), null);
    }
}
