<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class LocationViewModel
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $region,
        public readonly ?string $section,
        public readonly bool $hasCardinalDirections,
        public readonly bool $hasVerticalDirections,
        public readonly bool $hasExits,
        public readonly ?AdjacentLocationViewModel $north,
        public readonly ?AdjacentLocationViewModel $south,
        public readonly ?AdjacentLocationViewModel $east,
        public readonly ?AdjacentLocationViewModel $west,
        public readonly ?AdjacentLocationViewModel $up,
        public readonly ?AdjacentLocationViewModel $down,
        public readonly array $exits,
        public readonly array $directions,
    ) {}
}
