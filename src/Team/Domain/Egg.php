<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\Sex;

final class Egg
{
    public function __construct(
        public readonly string $firstParentPokedexNumber,
        public readonly Sex $firstParentSex,
        public readonly string $secondParentPokedexNumber,
        public readonly Sex $secondParentSex,
        public readonly int $remainingCycles,
    ) {}
}
