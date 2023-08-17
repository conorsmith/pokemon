<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokedexNumber
{
    public function __construct(
        public readonly string $value,
    ) {}

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }
}
