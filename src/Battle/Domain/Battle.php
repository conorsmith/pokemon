<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;

final class Battle
{
    public function __construct(
        public readonly string $id,
        public readonly string $trainerId,
        public readonly ?CarbonImmutable $dateLastBeaten,
        public readonly int $battleCount,
    ) {}

    public function defeat(): self
    {
        return new self(
            $this->id,
            $this->trainerId,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            $this->battleCount,
        );
    }

    public function playerHasWon(): bool
    {
        return !is_null($this->dateLastBeaten);
    }
}
