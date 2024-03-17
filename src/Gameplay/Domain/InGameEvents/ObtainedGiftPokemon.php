<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\InGameEvents;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use DateTimeImmutable;

final class ObtainedGiftPokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $giftPokemonId,
        public readonly string $pokedexNumber,
        public readonly string $locationId,
        public readonly DateTimeImmutable $obtainedAt,
    ) {}

    public function isInCooldownWindow(): bool
    {
        $obtainedAd = new CarbonImmutable($this->obtainedAt);

        return $obtainedAd->addWeek() > CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));
    }
}
