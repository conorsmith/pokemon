<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

use DateTimeImmutable;

final class LegendaryCaptureEvent
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly DateTimeImmutable $capturedAt,
    ) {}
}
