<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Config;

use DomainException;

final class WildEncounterTable
{
    public function __construct(
        public readonly string $encounterType,
        public readonly array $entries,
    ) {
        foreach ($this->entries as $entry) {
            if (!$entry instanceof WildEncounterTableEntry) {
                throw new DomainException();
            }
        }
    }
}
