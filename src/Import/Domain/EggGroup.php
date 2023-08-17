<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class EggGroup
{
    public function __construct(
        public readonly string $value,
    ) {}
}
