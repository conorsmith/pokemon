<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;

final class CaughtLocation
{
    public function __construct(
        public readonly string $locationId,
        public readonly Region $region,
    ) {}
}
