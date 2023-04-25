<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

final class Location
{
    public function __construct(
        public readonly string $id,
        public readonly array $adjacentLocations,
    ) {}
}
