<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels;

final class PokemonList
{
    public function __construct(
        public readonly int $filled,
        public readonly int $maximum,
        public readonly array $slots
    ) {}
}
