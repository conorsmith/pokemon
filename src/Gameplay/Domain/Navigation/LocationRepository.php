<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Navigation;

interface LocationRepository
{
    public function find(string $locationId): Location;

    public function findCurrentLocation(): Location;
}
