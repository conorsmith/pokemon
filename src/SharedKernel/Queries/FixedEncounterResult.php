<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Queries;

final class FixedEncounterResult
{
    public function __construct(
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly bool $isShiny,
        public readonly bool $isLegendary,
        public readonly int $level,
        public readonly bool $canBattle,
    ) {}
}
