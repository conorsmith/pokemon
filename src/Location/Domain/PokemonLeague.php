<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class PokemonLeague
{
    public function __construct(
        public readonly RegionId $regionId,
        public readonly bool $isPlayerChampion,
    ) {}
}
