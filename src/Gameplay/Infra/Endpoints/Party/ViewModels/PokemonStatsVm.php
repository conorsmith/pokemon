<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels;

final class PokemonStatsVm
{
    public function __construct(
        public readonly string $total,
        public readonly string $hp,
        public readonly string $physicalAttack,
        public readonly string $physicalDefence,
        public readonly string $specialAttack,
        public readonly string $specialDefence,
        public readonly string $speed,
    ) {}
}
