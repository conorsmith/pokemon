<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use LogicException;

final class WildEncounters
{
    public function __construct(
        public readonly bool $includesWalking,
        public readonly bool $includesSurfing,
        public readonly bool $includesFishing,
        public readonly bool $includesRockSmash,
        public readonly bool $includesHeadbutt,
    ) {}

    public function includes(string $encounterType): bool
    {
        return match ($encounterType) {
            "walking"   => $this->includesWalking,
            "surfing"   => $this->includesSurfing,
            "fishing"   => $this->includesFishing,
            "rockSmash" => $this->includesRockSmash,
            "headbutt"  => $this->includesHeadbutt,
            default     => throw new LogicException("Invalid encounter type '{$encounterType}'"),
        };
    }
}
