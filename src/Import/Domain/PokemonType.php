<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokemonType
{
    public function __construct(
        public readonly int $primaryType,
        public readonly ?int $secondaryType,
    ) {}

    public function hasSecondaryType(): bool
    {
        return !is_null($this->secondaryType);
    }
}
