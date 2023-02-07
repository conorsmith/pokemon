<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly int $level,
        public readonly int $friendship,
        public readonly bool $isShiny,
        public readonly ?int $teamPosition,
    ) {}
}
