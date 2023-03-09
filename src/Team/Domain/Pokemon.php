<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly Type $type,
        public readonly int $level,
        public readonly int $friendship,
        public readonly bool $isShiny,
        public readonly Hp $hp,
        public readonly Stat $physicalAttack,
        public readonly Stat $physicalDefence,
        public readonly Stat $specialAttack,
        public readonly Stat $specialDefence,
        public readonly Stat $speed,
    ) {}

    public function identicalTo(self $other): bool
    {
        return $this->id === $other->id
            && $this->number === $other->number
            && $this->type === $other->type
            && $this->level === $other->level
            && $this->friendship === $other->friendship
            && $this->isShiny === $other->isShiny;
    }

    public function hasSecondaryType(): bool
    {
        return !is_null($this->type->secondaryType);
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
            $this->type,
            $this->level + 1,
            $this->friendship,
            $this->isShiny,
            $this->hp,
            $this->physicalAttack,
            $this->physicalDefence,
            $this->specialAttack,
            $this->specialDefence,
            $this->speed,
        );
    }
}
