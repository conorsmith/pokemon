<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Battle;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;

final class LeagueChampion
{
    public static function player(RegionId $regionId): self
    {
        return new self($regionId, null);
    }

    public function __construct(
        public readonly RegionId $regionId,
        public readonly ?string $trainerId,
    ) {}

    public function isPlayer(): bool
    {
        return is_null($this->trainerId);
    }
}
