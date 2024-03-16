<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;

final class Battle
{
    public function __construct(
        public readonly string $id,
        public readonly string $trainerId,
        public readonly bool $isPlayerChallenger,
        public readonly ?CarbonImmutable $dateLastBeaten,
        public readonly int $battleCount,
    ) {}

    public function defeat(): self
    {
        return new self(
            $this->id,
            $this->trainerId,
            $this->isPlayerChallenger,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
            $this->battleCount,
        );
    }

    public function setPlayerAsChallenger(): self
    {
        return new self(
            $this->id,
            $this->trainerId,
            true,
            $this->dateLastBeaten,
            $this->battleCount,
        );
    }

    public function setTrainerAsChallenger(): self
    {
        return new self(
            $this->id,
            $this->trainerId,
            false,
            $this->dateLastBeaten,
            $this->battleCount,
        );
    }

    public function playerHasWon(): bool
    {
        return !is_null($this->dateLastBeaten);
    }
}
