<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Encounter;

final class ResultOfCreatingAnEncounter
{
    public function __construct(
        public readonly Encounter $encounter,
    ) {}
}
