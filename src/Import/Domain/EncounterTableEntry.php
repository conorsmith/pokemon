<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

use Exception;

final class EncounterTableEntry
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly int $weight,
        public readonly LevelRange $levelRange,
    ) {}

    public function merge(self $other): self
    {
        if (!$this->pokedexNumber->equals($other->pokedexNumber)) {
            throw new Exception;
        }

        return new self(
            $this->pokedexNumber,
            $this->weight + $other->weight,
            $this->levelRange->merge($other->levelRange),
        );
    }
}
