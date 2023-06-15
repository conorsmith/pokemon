<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly ?string $form,
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
        public readonly CaughtLocation $caughtLocation,
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

    public function levelUp(int $newLevel = null): self
    {
        return $this->clone(
            level: $newLevel ?? $this->level + 1,
        );
    }

    public function evolve(string $newNumber): self
    {
        return $this->clone(
            number: $newNumber,
        );
    }

    public function boostHpEv(int $increment): self
    {
        return $this->clone(
            hp: $this->hp->boostEv($increment),
        );
    }

    public function boostPhysicalAttackEv(int $increment): self
    {
        return $this->clone(
            physicalAttack: $this->physicalAttack->boostEv($increment),
        );
    }

    public function boostPhysicalDefenceEv(int $increment): self
    {
        return $this->clone(
            physicalDefence: $this->physicalDefence->boostEv($increment),
        );
    }

    public function boostSpecialAttackEv(int $increment): self
    {
        return $this->clone(
            specialAttack: $this->specialAttack->boostEv($increment),
        );
    }

    public function boostSpecialDefenceEv(int $increment): self
    {
        return $this->clone(
            specialDefence: $this->specialDefence->boostEv($increment),
        );
    }

    public function boostSpeedEv(int $increment): self
    {
        return $this->clone(
            speed: $this->speed->boostEv($increment),
        );
    }

    private function clone(
        string $id = null,
        string $number = null,
        ?string $form = null,
        Type $type = null,
        int $level = null,
        int $friendship = null,
        bool $isShiny = null,
        Hp $hp = null,
        Stat $physicalAttack = null,
        Stat $physicalDefence = null,
        Stat $specialAttack = null,
        Stat $specialDefence = null,
        Stat $speed = null,
        CaughtLocation $caughtLocation = null,
    ) {
        return new self(
            $id ?? $this->id,
            $number ?? $this->number,
            $form ?? $this->form,
            $type ?? $this->type,
            $level ?? $this->level,
            $friendship ?? $this->friendship,
            $isShiny ?? $this->isShiny,
            $hp ?? $this->hp,
            $physicalAttack ?? $this->physicalAttack,
            $physicalDefence ?? $this->physicalDefence,
            $specialAttack ?? $this->specialAttack,
            $specialDefence ?? $this->specialDefence,
            $speed ?? $this->speed,
            $caughtLocation ?? $this->caughtLocation,
        );
    }
}
