<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\InGameEvents;

use DateTimeImmutable;

final class FixedEncounterCaptureEvent
{
    public function __construct(
        public readonly string $id,
        public readonly string $fixedEncounterId,
        public readonly string $locationId,
        public readonly string $pokedexNumber,
        public readonly DateTimeImmutable $capturedAt,
    ) {}
}
