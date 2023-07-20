<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Encounter;

final class ResultOfCreatingAnEncounter
{
    public function __construct(
        public readonly Encounter $encounter,
    ) {}
}
