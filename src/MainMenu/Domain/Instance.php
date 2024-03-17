<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Domain;

use ConorSmith\Pokemon\SharedKernel\InstanceId;
use DateTimeImmutable;

final class Instance
{
    public function __construct(
        public readonly InstanceId $id,
        public readonly DateTimeImmutable $startedAt,
        public readonly string $currentLocation,
    ) {}
}
