<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

final class Egg
{
    public function __construct(
        public readonly string $id,
        public readonly string $pokedexNumber,
        public readonly ?string $form,
        public readonly Stats $ivs,
        public readonly ?EggParents $parents,
        public readonly int $remainingCycles,
    ) {}

    public function hasKnownParents(): bool
    {
        return !is_null($this->parents);
    }

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
            $this->ivs,
            $this->parents,
            max(0, $this->remainingCycles - $amount),
        );
    }
}
