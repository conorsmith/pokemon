<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\Party\Domain\LegendaryCaptureEvent;
use ConorSmith\Pokemon\Party\Repositories\LegendaryCaptureEventRepositoryDb;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeLegendaryPokemonWasCapturedQuery as QueryInterface;
use DateTimeImmutable;

final class LastTimeLegendaryPokemonWasCapturedQuery implements QueryInterface
{
    public function __construct(
        private readonly LegendaryCaptureEventRepositoryDb $legendaryCaptureEventRepository,
    ) {}

    public function run(string $pokedexNumber): ?DateTimeImmutable
    {
        /** @var LegendaryCaptureEvent[] $events */
        $events = $this->legendaryCaptureEventRepository->findForPokemonInReverseChronologicalOrder($pokedexNumber);

        if (count($events) === 0) {
            return null;
        }

        return $events[0]->capturedAt;
    }
}
