<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Domain;

use ConorSmith\Pokemon\ItemId;

final class GameInstance
{
    public function __construct(
        public readonly string $id,
        public readonly int $money,
        public readonly int $unusedRareCandy,
        public readonly int $unusedChallengeTokens,
        public readonly int $unusedPokeBalls,
    ) {}

    public function hasUnusedChallengeTokens(): bool
    {
        return $this->unusedChallengeTokens > 0;
    }

    public function winPrize(string $prize): self
    {
        $unusedRareCandy = $this->unusedRareCandy;
        $unusedChallengeTokens = $this->unusedChallengeTokens;
        $unusedPokeBalls = $this->unusedPokeBalls;

        switch ($prize) {
            case ItemId::POKE_BALL:
                $unusedPokeBalls++;
                break;
            case ItemId::RARE_CANDY:
                $unusedRareCandy++;
                break;
            case ItemId::CHALLENGE_TOKEN:
                $unusedChallengeTokens++;
                break;
        }

        return new self(
            $this->id,
            $this->money,
            $unusedRareCandy,
            $unusedChallengeTokens,
            $unusedPokeBalls,
        );
    }

    public function useAChallengeToken(): self
    {
        return new self(
            $this->id,
            $this->money,
            $this->unusedRareCandy,
            $this->unusedChallengeTokens - 1,
            $this->unusedPokeBalls,
        );
    }
}
