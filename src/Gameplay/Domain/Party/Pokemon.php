<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

use ConorSmith\Pokemon\Gameplay\Domain\Breeding\EggGroup;
use ConorSmith\Pokemon\Gameplay\Domain\PartyAssessment\Type;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use LogicException;

final class Pokemon
{
    public function __construct(
        public readonly string $id,
        public readonly string $number,
        public readonly ?string $form,
        public readonly Type $type,
        public readonly EggGroups $eggGroups,
        public readonly int $level,
        public readonly int $friendship,
        public readonly Sex $sex,
        public readonly bool $isShiny,
        public readonly Hp $hp,
        public readonly Stat $physicalAttack,
        public readonly Stat $physicalDefence,
        public readonly Stat $specialAttack,
        public readonly Stat $specialDefence,
        public readonly Stat $speed,
        public readonly CaughtLocation $caughtLocation,
        public readonly ?string $heldItemId,
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

    public function canBreed(): bool
    {
        return $this->eggGroups->firstEggGroup !== EggGroup::NO_EGGS_DISCOVERED;
    }

    public function canBreedWith(self $other): bool
    {
        return match($this->sex) {
            Sex::FEMALE  => $other->sex === Sex::MALE
                || $other->number === PokedexNo::DITTO,

            Sex::MALE    => $other->sex === Sex::FEMALE
                || $other->number === PokedexNo::DITTO,

            Sex::UNKNOWN => $other->number === PokedexNo::DITTO,
        };
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

    public function isHoldingAnItem(): bool
    {
        return !is_null($this->heldItemId);
    }

    public function giveItem(string $itemId): self
    {
        if ($this->isHoldingAnItem()) {
            throw new LogicException();
        }

        return $this->clone(
            heldItemId: $itemId,
        );
    }

    public function takeItem(): self
    {
        if (!$this->isHoldingAnItem()) {
            throw new LogicException();
        }

        return new self(
            $this->id,
            $this->number,
            $this->form,
            $this->type,
            $this->eggGroups,
            $this->level,
            $this->friendship,
            $this->sex,
            $this->isShiny,
            $this->hp,
            $this->physicalAttack,
            $this->physicalDefence,
            $this->specialAttack,
            $this->specialDefence,
            $this->speed,
            $this->caughtLocation,
            null,
        );
    }

    private function clone(
        string $id = null,
        string $number = null,
        ?string $form = null,
        Type $type = null,
        EggGroups $eggGroups = null,
        int $level = null,
        int $friendship = null,
        Sex $sex = null,
        bool $isShiny = null,
        Hp $hp = null,
        Stat $physicalAttack = null,
        Stat $physicalDefence = null,
        Stat $specialAttack = null,
        Stat $specialDefence = null,
        Stat $speed = null,
        CaughtLocation $caughtLocation = null,
        ?string $heldItemId = null,
    ) {
        return new self(
            $id ?? $this->id,
            $number ?? $this->number,
            $form ?? $this->form,
            $type ?? $this->type,
            $eggGroups ?? $this->eggGroups,
            $level ?? $this->level,
            $friendship ?? $this->friendship,
            $sex ?? $this->sex,
            $isShiny ?? $this->isShiny,
            $hp ?? $this->hp,
            $physicalAttack ?? $this->physicalAttack,
            $physicalDefence ?? $this->physicalDefence,
            $specialAttack ?? $this->specialAttack,
            $specialDefence ?? $this->specialDefence,
            $speed ?? $this->speed,
            $caughtLocation ?? $this->caughtLocation,
            $heldItemId ?? $this->heldItemId,
        );
    }
}
