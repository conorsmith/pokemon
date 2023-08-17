<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

final class TeamPokemon
{
    public function __construct(
        public readonly int $friendship,
        public readonly int $basePhysicalAttack,
        public readonly int $basePhysicalDefence,
        public readonly int $baseSpecialAttack,
        public readonly int $baseSpecialDefence,
        public readonly int $baseSpeed,
        public readonly int $baseHp,
        public readonly int $ivPhysicalAttack,
        public readonly int $ivPhysicalDefence,
        public readonly int $ivSpecialAttack,
        public readonly int $ivSpecialDefence,
        public readonly int $ivSpeed,
        public readonly int $ivHp,
        public readonly int $evPhysicalAttack,
        public readonly int $evPhysicalDefence,
        public readonly int $evSpecialAttack,
        public readonly int $evSpecialDefence,
        public readonly int $evSpeed,
        public readonly int $evHp,
    ) {}
}
