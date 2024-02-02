<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class NavigationBar
{
    public function __construct(
        public readonly bool $showWildEncounters,
        public readonly bool $showTrainers,
        public readonly bool $showGiftPokemon,
        public readonly bool $showLegendaryEncounters,
        public readonly bool $showEliteFour,
    ) {}
}
