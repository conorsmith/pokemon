<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

final class ParentalRelationship
{
    public function __construct(
        public readonly string $subjectId,
        public readonly string $firstParentId,
        public readonly string $secondParentId,
    ) {}
}
