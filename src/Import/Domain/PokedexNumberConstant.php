<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class PokedexNumberConstant
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    ) {}
}
