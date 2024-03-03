<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\Party\Domain\FixedEncounterCaptureEvent;
use ConorSmith\Pokemon\Party\Repositories\FixedEncounterCaptureEventRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeFixedEncounterPokemonWasCapturedQuery as QueryInterface;
use DateTimeImmutable;

final class LastTimeFixedEncounterPokemonWasCapturedQuery implements QueryInterface
{
    public function __construct(
        private readonly FixedEncounterCaptureEventRepositoryDb $fixedEncounterCaptureEventRepositoryDb,
    ) {}

    public function run(string $fixedEncounterId): ?DateTimeImmutable
    {
        /** @var FixedEncounterCaptureEvent[] $events */
        $events = $this->fixedEncounterCaptureEventRepositoryDb->findForPokemonInReverseChronologicalOrder(
            $fixedEncounterId,
        );

        if (count($events) === 0) {
            return null;
        }

        return $events[0]->capturedAt;
    }
}
