<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

interface AreaRepository
{
    public function find(string $locationId): ?Area;
}
