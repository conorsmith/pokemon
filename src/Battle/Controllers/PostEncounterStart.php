<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Controllers;

use ConorSmith\Pokemon\Battle\UseCase\StartAnEncounter;

final class PostEncounterStart
{
    public function __construct(
        private readonly StartAnEncounter $startAnEncounter,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterId = $args['id'];

        $this->startAnEncounter->__invoke($encounterId);

        header("Location: /encounter/{$encounterId}");
    }
}
