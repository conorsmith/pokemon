<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

final class EggParents
{
    public function __construct(
        public readonly string $firstParentId,
        public readonly string $secondParentId,
    ) {}
}
