<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class NavigationBar
{
    public function __construct(
        public readonly bool $showPokemon,
        public readonly bool $showTrainers,
        public readonly bool $showLegendaryEncounters,
        public readonly bool $showEliteFour,
    ) {}
}
