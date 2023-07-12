<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

use ConorSmith\Pokemon\Sex;

final class Egg
{
    public function __construct(
        public readonly string $id,
        public readonly string $firstParentPokedexNumber,
        public readonly Sex $firstParentSex,
        public readonly string $secondParentPokedexNumber,
        public readonly Sex $secondParentSex,
        public readonly int $remainingCycles,
    ) {}

    public function reduceCycles(int $amount): self
    {
        return new self(
            $this->id,
            $this->firstParentPokedexNumber,
            $this->firstParentSex,
            $this->secondParentPokedexNumber,
            $this->secondParentSex,
            max(0, $this->remainingCycles - $amount),
        );
    }
}
