<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

final class ResultOfLevellingUp
{
    public static function beyondLevelLimit(int $levelLimit): self
    {
        return new self(
            beyondLevelLimit: true,
            levelLimit: $levelLimit,
        );
    }

    public static function levelledUpAndEvolved(int $newLevel, string $newPokedexNumber): self
    {
        return new self(
            newLevel: $newLevel,
            evolved: true,
            newPokedexNumber: $newPokedexNumber,
        );
    }

    public static function levelledUp(int $newLevel): self
    {
        return new self(
            newLevel: $newLevel,
        );
    }

    public function __construct(
        public readonly ?int $newLevel = null,
        public readonly bool $beyondLevelLimit = false,
        public readonly ?int $levelLimit = null,
        public readonly bool $evolved = false,
        public readonly ?string $newPokedexNumber = null,
    ) {}
}
