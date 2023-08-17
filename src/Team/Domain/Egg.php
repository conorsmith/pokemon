<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

final class Egg
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly int $ivHp,
        public readonly int $ivPhysicalAttack,
        public readonly int $ivPhysicalDefence,
        public readonly int $ivSpecialAttack,
        public readonly int $ivSpecialDefence,
        public readonly int $ivSpeed,
        public readonly string $firstParentId,
        public readonly string $secondParentId,
        public readonly int $remainingCycles,
    ) {}

    public function canHatch(): bool
    {
        return $this->remainingCycles === 0;
    }

    public function reduceCycles(int $amount): self
    {
        return new self(
            $this->id,
            $this->pokedexNumber,
            $this->form,
            $this->ivHp,
            $this->ivPhysicalAttack,
            $this->ivPhysicalDefence,
            $this->ivSpecialAttack,
            $this->ivSpecialDefence,
            $this->ivSpeed,
            $this->firstParentId,
            $this->secondParentId,
            max(0, $this->remainingCycles - $amount),
        );
    }
}
