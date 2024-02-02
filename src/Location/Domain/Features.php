<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

final class Features
{
    public function __construct(
        public readonly bool $hasWildEncounters,
        public readonly bool $hasTrainers,
        public readonly bool $hasGiftPokemon,
        public readonly bool $hasLegendaryEncounters,
        public readonly bool $hasEliteFour,
    ) {}
}
