<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\EncounterType as EncounterTypeConstants;
use ConorSmith\Pokemon\Import\Domain\EncounterTable;
use ConorSmith\Pokemon\Import\Domain\EncounterTableEntry;
use ConorSmith\Pokemon\Import\Domain\EncounterType;
use ConorSmith\Pokemon\Import\Domain\LevelRange;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ReflectionClass;

final class EncountersConfig
{
    public static function fromEncounterTables(array $encounterTables): string
    {
        $config = "";

        foreach ($encounterTables as $groupName => $encounterTableGroup) {

            if (count($encounterTables) > 1) {
                $config .= "## " . strtoupper($groupName) . PHP_EOL;
            }

            $config .= "[" . PHP_EOL;

            /** @var EncounterTable $encounterTable */
            foreach ($encounterTableGroup as $encounterTable) {
                $config .= self::encodeEncounterTable($encounterTable);
            }

            $config .= "]," . PHP_EOL;
            $config .= PHP_EOL;
        }

        return $config;
    }

    private static function encodeEncounterTable(EncounterTable $encounterTable): string
    {
        $config = "";

        $config .= "    " . self::encodeEncounterType($encounterTable->encounterType) . " => [" . PHP_EOL;
        /** @var EncounterTableEntry $entry */
        foreach ($encounterTable->entries as $entry) {
            $config .= self::encodeEncounterTypeEntry($entry);
        }
        $config .= "    ]," . PHP_EOL;

        return $config;
    }

    private static function encodeEncounterType(EncounterType $encounterType): string
    {
        $reflector = new ReflectionClass(EncounterTypeConstants::class);
        $constants = $reflector->getConstants();
        unset($constants['ALL']);
        $constants = array_flip($constants);

        return $reflector->getShortName() . "::" . $constants[$encounterType->value];
    }

    private static function encodeEncounterTypeEntry(EncounterTableEntry $entry): string
    {
        $config = "";

        $config .= "        " . self::encodePokedexNumber($entry->pokedexNumber) . " => [" . PHP_EOL;
        $config .= "            'weight' => {$entry->weight}," . PHP_EOL;
        $config .= "            'levels' => " . self::encodeLevelRange($entry->levelRange) . "," . PHP_EOL;
        $config .= "        ]," . PHP_EOL;

        return $config;
    }

    private static function encodePokedexNumber(PokedexNumber $pokedexNumber): string
    {
        $reflector = new ReflectionClass(PokedexNumberConstants::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$pokedexNumber->value];
    }

    private static function encodeLevelRange(LevelRange $levelRange): string
    {
        if (is_null($levelRange->upperBound)) {
            return "{$levelRange->lowerBound}";
        } else {
            return "[{$levelRange->lowerBound}, {$levelRange->upperBound}]";
        }
    }
}