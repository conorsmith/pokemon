<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class Encounter
{
    public function __construct(
        public readonly string $id,
        public readonly Pokemon $pokemon,
        public readonly bool $hasStarted,
        public readonly bool $isLegendary,
        public readonly bool $isRegistered,
        public readonly bool $wasCaught,
    ) {}

    public function captured(): self
    {
        return new self(
            $this->id,
            $this->pokemon,
            $this->hasStarted,
            $this->isLegendary,
            $this->isRegistered,
            true,
        );
    }

    public function start(): self
    {
        return new self(
            $this->id,
            $this->pokemon,
            true,
            $this->isLegendary,
            $this->isRegistered,
            $this->wasCaught,
        );
    }
}
