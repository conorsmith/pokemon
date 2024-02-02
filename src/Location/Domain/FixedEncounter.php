<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use DateTimeImmutable;

final class FixedEncounter
{
    public function __construct(
        public readonly string $pokedexNumber,
        public readonly int $level,
        public readonly bool $canBattle,
        public readonly ?DateTimeImmutable $lastCaptured,
    ) {}
}
