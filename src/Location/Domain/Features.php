<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

final class Features
{
    public function __construct(
        public readonly bool $hasWildEncounters,
        public readonly bool $hasFixedEncounters,
        public readonly bool $hasTrainers,
        public readonly bool $hasGiftPokemon,
        public readonly bool $hasLegendaryEncounters,
        public readonly bool $hasEliteFour,
    ) {}

    public function hasPokemon(): bool
    {
        return $this->hasWildEncounters
            || $this->hasFixedEncounters
            || $this->hasGiftPokemon
            || $this->hasLegendaryEncounters;
    }
}
