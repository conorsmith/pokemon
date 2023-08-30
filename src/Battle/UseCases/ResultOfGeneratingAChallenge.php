<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use LogicException;

final class ResultOfGeneratingAChallenge
{
    public static function generated(RegionId $regionId, string $trainerId): self
    {
        return new self(true, $regionId, $trainerId);
    }

    public static function notGenerated(): self
    {
        return new self(false, null, null);
    }

    private function __construct(
        public readonly bool $wasGenerated,
        private readonly ?RegionId $regionId,
        private readonly ?string $trainerId,
    ) {}

    public function getRegionId(): RegionId
    {
        if (!$this->wasGenerated) {
            throw new LogicException;
        }

        return $this->regionId;
    }

    public function getTrainerId(): string
    {
        if (!$this->wasGenerated) {
            throw new LogicException;
        }

        return $this->trainerId;
    }
}
