<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\Sex;

class PartyMember
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly Sex $sex,
        public readonly int $level,
        public readonly bool $isShiny,
    ) {}
}
