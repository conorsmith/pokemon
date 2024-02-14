<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\SharedKernel\Config\WildEncountersEntry;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTable;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTableEntry;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use WeakMap;

final class WildEncounterConfigRepository
{
    private WeakMap $config;

    public function __construct()
    {
        $this->config = new WeakMap();
        $this->config[RegionId::KANTO] = require __DIR__ . "/Config/Encounters/Kanto.php";
        $this->config[RegionId::JOHTO] = require __DIR__ . "/Config/Encounters/Johto.php";
        $this->config[RegionId::HOENN] = require __DIR__ . "/Config/Encounters/Hoenn.php";
    }

    public function allByRegion(): WeakMap
    {
        return $this->config;
    }

    public function findWildEncounters(string $locationId): WildEncountersEntry
    {
        foreach ($this->config as $config) {
            if (!array_key_exists($locationId, $config)) {
                continue;
            }

            $tables = [];

            /**
             * @var string $encounterType
             * @var array $tableConfig
             */
            foreach ($config[$locationId] as $encounterType => $tableConfig) {
                $tableEntries = [];

                /**
                 * @var int $pokedexNumber
                 * @var array $tableEntryConfig
                 */
                foreach ($tableConfig as $pokedexNumber => $tableEntryConfig) {

                    if (array_is_list($tableEntryConfig)) {
                        $multipleFormTableEntryConfig = $tableEntryConfig;

                        /** @var array $multipleFormTableEntryConfigEntry */
                        foreach ($multipleFormTableEntryConfig as $multipleFormTableEntryConfigEntry) {
                            $tableEntries[] = WildEncounterTableEntry::fromConfig(
                                strval($pokedexNumber),
                                $multipleFormTableEntryConfigEntry,
                            );
                        }

                    } else {
                        $tableEntries[] = WildEncounterTableEntry::fromConfig(
                            strval($pokedexNumber),
                            $tableEntryConfig,
                        );
                    }
                }

                $tables[] = new WildEncounterTable(
                    $encounterType,
                    $tableEntries,
                );
            }

            return new WildEncountersEntry($locationId, $tables);
        }

        return [];
    }
}
