<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use ConorSmith\Pokemon\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class Location
{
    public function __construct(
        public readonly string $id,
        private readonly RegionId $region,
    ) {}

    public function calculateRegionalLevelOffset(): int
    {
        if ($this->id === LocationId::JOHTO_LEAGUE_CHAMBER) {
            return 50;
        }

        return match($this->region) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
        };
    }
}
