<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;
final class Trainer
{
    public function __construct(
        public readonly string $id,
        public readonly string $class,
        public readonly Gender $gender,
        public readonly ?string $name,
        public readonly array $party,
    ) {}
}
