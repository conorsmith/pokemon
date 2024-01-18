<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use DateTimeImmutable;

final class ObtainedGiftPokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly string $locationId,
        public readonly DateTimeImmutable $obtainedAt,
    ) {}

    public function isInCooldownWindow(): bool
    {
        return $this->obtainedAt->addWeek() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
    }
}
