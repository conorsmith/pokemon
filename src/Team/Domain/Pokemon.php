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
    ) {}

    public function identicalTo(self $other): bool
    {
        return $this->id === $other->id
            && $this->number === $other->number
            && $this->level === $other->level
            && $this->friendship === $other->friendship
            && $this->isShiny === $other->isShiny;
    }

    public function hasMaxFriendship(): bool
    {
        return $this->friendship === 255;
    }

    public function levelUp(): self
    {
        return new self(
            $this->id,
            $this->number,
            $this->level + 1,
            $this->friendship,
            $this->isShiny,
        );
    }
}