<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class EncounterTable
{
    public function __construct(
        public readonly EncounterType $encounterType,
        public readonly array $entries,
    ) {}

    public function add(EncounterTableEntry $entry): self
    {
        $updatedEntries = $this->entries;

        if (!array_key_exists($entry->pokedexNumber->value, $this->entries)) {
            $updatedEntries[$entry->pokedexNumber->value] = $entry;
        } else {
            $updatedEntries[$entry->pokedexNumber->value] = $this->entries[$entry->pokedexNumber->value]->merge($entry);
        }

        return new self(
            $this->encounterType,
            $updatedEntries,
        );
    }
}
