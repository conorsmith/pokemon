<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\Domain;

final class Evolution
{
    public function __construct(
        public readonly PokedexNumber $pokedexNumber,
        public readonly ?int $level,
        public readonly ?string $itemId,
        public readonly bool $highFriendship,
        public readonly string|int|null $move,
        public readonly ?string $time,
        public readonly ?string $holding,
        public readonly ?string $stats,
        public readonly bool $randomly,
        public readonly ?string $gender,
    ) {}
}
