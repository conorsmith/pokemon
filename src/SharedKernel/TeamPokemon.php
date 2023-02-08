<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

final class TeamPokemon
{
    public function __construct(
        public readonly int $friendship,
    ) {}
}
