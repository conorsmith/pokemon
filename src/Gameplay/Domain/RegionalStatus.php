<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use DomainException;

final class RegionalStatus
{
    public function __construct(
        public readonly RegionId $regionId,
        public readonly bool $hasAccess,
        public readonly array $badges,
        public readonly bool $isChampion,
    ) {
        foreach ($this->badges as $badge) {
            if (!$badge instanceof GymBadge) {
                throw new DomainException();
            }
        }
    }
}
