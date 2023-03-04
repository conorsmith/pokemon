<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

final class TeamPokemon
{
    public function __construct(
        public readonly int $friendship,
        public readonly int $physicalAttack,
        public readonly int $physicalDefence,
        public readonly int $specialAttack,
        public readonly int $specialDefence,
        public readonly int $speed,
        public readonly int $hp,
    ) {}
}
