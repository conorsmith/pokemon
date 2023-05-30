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

        foreach ($bulbapediaEncounters as $key => $encounterGroup) {
            $encounterTables[$key] = [];
            /** @var BulbapediaEncounter $encounter */
            foreach ($encounterGroup as $encounter) {
                $encounterType = $this->createEncounterType($encounter->type);

                if ($encounterType->isIrrelevant()) {
                    continue;
                }

                if (!array_key_exists($encounterType->value, $encounterTables[$key])) {
                    $encounterTables[$key][$encounterType->value] = new EncounterTable(
                        $encounterType,
                        [],
                    );
                }

                $encounterTableEntry = new EncounterTableEntry(
                    $this->createPokedexNumberFromPokemonName($encounter->name),
                    self::createWeight($encounter),
                    $this->createLevelRange($encounter->levels),
                );

                $encounterTables[$key][$encounterType->value] = $encounterTables[$key][$encounterType->value]->add($encounterTableEntry);
            }
        }

        return $encounterTables;
    }

    private static function createWeight(BulbapediaEncounter $encounter): int
    {
        if (is_string($encounter->rate)) {
            return intval($encounter->rate);
        }

        return array_reduce(
            $encounter->rate,
            fn (int $carry, string $rate) => max($carry, intval($rate)),
            0
        );
    }

    private function createEncounterType(string $value): EncounterType
    {
        if (in_array($value, ["Cave", "Grass", "2F-3F", "1F", "B1F", "2F-9F", "2F-10F"])) {
            return new EncounterType(EncounterTypeConstants::WALKING);
        }

        if ($value === "Surfing") {
            return new EncounterType(EncounterTypeConstants::SURFING);
        }

        if (substr($value, 0, 7) === "Fishing") {
            return new EncounterType(EncounterTypeConstants::FISHING);
        }

        if ($value === "Rock Smash") {
            return new EncounterType(EncounterTypeConstants::ROCK_SMASH);
        }

        if ($value === "Only one"
            || $value === "Egg"
            || $value === "Headbutt"
            || $value === "Hoenn Sound"
            || $value === "Sinnoh Sound"
            || $value === "Swarm"
            || $value === "Starter Pokémon"
            || $value === "Gift"
            || $value === "Horde Encounter"
            || substr($value, 0, 5) === "Trade"
            || substr($value, 0, 5) === "Event"
        ) {
            return EncounterType::irrelevant();
        }

        throw new Exception("Invalid value '$value'");
    }

    private function createPokedexNumberFromPokemonName(string $name): PokedexNumber
    {
        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);

        $name = strtoupper($name);
        $name = str_replace("♀", "_F", $name);
        $name = str_replace("♂", "_M", $name);
        $name = str_replace("'", "_", $name);
        $name = str_replace(".", "", $name);
        $name = str_replace(" ", "_", $name);

        return new PokedexNumber(
            $pokedexNoReflector->getConstants()[$name],
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
