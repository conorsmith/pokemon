<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Domain;

use ConorSmith\Pokemon\Domain\Battle\Trainer;

final class GameInstance
{
    public function __construct(
        public readonly string $id,
        public readonly int $money,
        public readonly int $unusedChallengeTokens,
    ) {}

    public function hasUnusedChallengeTokens(): bool
    {
        return $this->unusedChallengeTokens > 0;
    }

    public function winPrizeMoney(Trainer $trainer): self
    {
        return new self(
            $this->id,
            $this->money + $trainer->prizeMoney,
            $this->unusedChallengeTokens
        );
    }

    public function useAChallengeToken(): self
    {
        return new self(
            $this->id,
            $this->money,
            $this->unusedChallengeTokens - 1
        );
    }
}
