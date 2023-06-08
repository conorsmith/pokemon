<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;

final class EncounterLocation
{
    public function __construct(
        public readonly string $locationId,
        public readonly Region $region,
        public readonly string $encounterType,
        public readonly float $rarity,
    ) {}
}
