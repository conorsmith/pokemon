<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use Exception;

final class Encounter
{
    public const MAXIMUM_STRENGTH_INDICATOR_PROGRESS = 3;

    public function __construct(
        public readonly string $id,
        public readonly Pokemon $pokemon,
        public readonly bool $hasStarted,
        public readonly bool $isRegistered,
        public readonly bool $wasCaught,
        public readonly int $strengthIndicatorProgress,
        public readonly ?string $fixedEncounterId,
    ) {}

    public function captured(): self
    {
        return new self(
            $this->id,
            $this->pokemon,
            $this->hasStarted,
            $this->isRegistered,
            true,
            $this->strengthIndicatorProgress,
            $this->fixedEncounterId,
        );
    }

    public function start(): self
    {
        return new self(
            $this->id,
            $this->pokemon,
            true,
            $this->isRegistered,
            $this->wasCaught,
            $this->strengthIndicatorProgress,
            $this->fixedEncounterId,
        );
    }

    public function canStrengthIndicatorProgress(): bool
    {
        return $this->strengthIndicatorProgress < self::MAXIMUM_STRENGTH_INDICATOR_PROGRESS;
    }

    public function strengthIndicatorProgresses(): self
    {
        if (!$this->canStrengthIndicatorProgress()) {
            throw new Exception;
        }

        return new self(
            $this->id,
            $this->pokemon,
            $this->hasStarted,
            $this->isRegistered,
            $this->wasCaught,
            $this->strengthIndicatorProgress + 1,
            $this->fixedEncounterId,
        );
    }
}
