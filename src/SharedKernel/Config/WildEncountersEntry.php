<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Config;

use DomainException;
use LogicException;

final class WildEncountersEntry
{
    public function __construct(
        public readonly string $locationId,
        public readonly array $tables,
    ) {
        foreach ($this->tables as $table) {
            if (!$table instanceof WildEncounterTable) {
                throw new DomainException();
            }
        }
    }

    public function hasTables(): bool
    {
        return count($this->tables) > 0;
    }

    public function hasTable(string $encounterType): bool
    {
        /** @var WildEncounterTable $table */
        foreach ($this->tables as $table) {
            if ($table->encounterType === $encounterType) {
                return true;
            }
        }

        return false;
    }

    public function getTable(string $encounterType): WildEncounterTable
    {
        /** @var WildEncounterTable $table */
        foreach ($this->tables as $table) {
            if ($table->encounterType === $encounterType) {
                return $table;
            }
        }

        throw new LogicException();
    }
}
