<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;

final class LevelUpPokemonResult
{
    public static function beyondLevelLimit(int $levelLimit): self
    {
        return new self(
            beyondLevelLimit: true,
            levelLimit: $levelLimit,
        );
    }

    public static function nincadaEvolvedIntoNinjask(int $newLevel, bool $newPokedexEntry): self
    {
        return new self(
            newLevel: $newLevel,
            evolved: true,
            newPokedexNumber: PokedexNo::NINJASK,
            newPokedexEntry: $newPokedexEntry,
            isNincadaEvolution: true,
        );
    }

    public static function levelledUpAndEvolved(int $newLevel, string $newPokedexNumber, bool $newPokedexEntry): self
    {
        return new self(
            newLevel: $newLevel,
            evolved: true,
            newPokedexNumber: $newPokedexNumber,
            newPokedexEntry: $newPokedexEntry,
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
        public readonly bool $newPokedexEntry = false,
        public readonly bool $isNincadaEvolution = false,
    ) {}
}
