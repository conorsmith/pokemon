<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

final class WildEncounters
{
    public function __construct(
        public readonly bool $includesWalking,
        public readonly bool $includesSurfing,
        public readonly bool $includesFishing,
        public readonly bool $includesRockSmash,
        public readonly bool $includesHeadbutt,
    ) {}

    public function includesAny(): bool
    {
        return $this->includesWalking
            || $this->includesSurfing
            || $this->includesFishing
            || $this->includesRockSmash
            || $this->includesHeadbutt;
    }
}
