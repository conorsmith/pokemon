<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use Exception;

final class EliteFourChallenge
{
    public function __construct(
        public readonly string $id,
        public readonly RegionId $region,
        public readonly ?string $trainerId,
        public readonly array $memberIds,
        public readonly array $team,
        public readonly int $stage,
        public readonly bool $victory,
        public readonly ?CarbonImmutable $dateCompleted,
    ) {}

    public function getMemberIdForCurrentStage(): string
    {
        return $this->memberIds[$this->stage];
    }

    public function isInProgress(): bool
    {
        return is_null($this->dateCompleted);
    }

    public function isInFinalStage(): bool
    {
        return $this->stage === count($this->memberIds) - 1;
    }

    public function isPlayerTheChallenger(): bool
    {
        return is_null($this->trainerId);
    }

    public function win(): self
    {
        return new self(
            $this->id,
            $this->region,
            $this->trainerId,
            $this->memberIds,
            $this->team,
            $this->stage,
            true,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        );
    }

    public function lose(): self
    {
        return new self(
            $this->id,
            $this->region,
            $this->trainerId,
            $this->memberIds,
            $this->team,
            $this->stage,
            $this->victory,
            CarbonImmutable::now(new CarbonTimeZone("Europe/Dublin")),
        );
    }

    public function proceedToNextStage(): self
    {
        if ($this->isInFinalStage()) {
            throw new Exception();
        }

        return new self(
            $this->id,
            $this->region,
            $this->trainerId,
            $this->memberIds,
            $this->team,
            $this->stage + 1,
            $this->victory,
            $this->dateCompleted,
        );
    }
}
