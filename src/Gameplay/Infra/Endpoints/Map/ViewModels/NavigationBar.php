<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels;

final class NavigationBar
{
    public function __construct(
        public readonly bool $showPokemon,
        public readonly bool $showTrainers,
        public readonly bool $showEliteFour,
        public readonly bool $showFacilities,
    ) {}
}
