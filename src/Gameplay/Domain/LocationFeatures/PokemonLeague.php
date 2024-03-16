<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class PokemonLeague
{
    public function __construct(
        public readonly RegionId $regionId,
        public readonly bool $isPlayerChampion,
    ) {}
}
