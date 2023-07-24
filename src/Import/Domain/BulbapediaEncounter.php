<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class BulbapediaEncounter
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $form,
        public readonly string $type,
        public readonly string $levels,
        public readonly string|array $rate,
    ) {}
}
