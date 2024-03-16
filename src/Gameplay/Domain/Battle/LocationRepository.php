<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

interface LocationRepository
{
    public function findCurrentLocation(): Location;
}
