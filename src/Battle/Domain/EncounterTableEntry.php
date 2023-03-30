<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class EncounterTableEntry
{
    public function __construct(
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $weight,
        public readonly int $levelsLowerBound,
        public readonly int $levelsUpperBound,
    ) {}

    public function generateLevel(): int
    {
        return mt_rand(
            $this->levelsLowerBound,
            $this->levelsUpperBound,
        );
    }
}
