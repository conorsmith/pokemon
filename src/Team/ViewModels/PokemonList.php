<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\ViewModels;

final class PokemonList
{
    public function __construct(
        public readonly int $filled,
        public readonly int $maximum,
        public readonly array $slots
    ) {}
}
