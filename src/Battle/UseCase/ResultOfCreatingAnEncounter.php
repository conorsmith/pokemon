<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCase;

use ConorSmith\Pokemon\Battle\Domain\Encounter;

final class ResultOfCreatingAnEncounter
{
    public function __construct(
        public readonly Encounter $encounter,
    ) {}
}
