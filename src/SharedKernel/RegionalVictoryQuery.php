<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use ConorSmith\Pokemon\SharedKernel\Domain\Region;

interface RegionalVictoryQuery
{
    public function run(Region $region): bool;
}
