<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

class StartSurveyingPokemonResult
{
    public static function noWildEncounters(): self
    {
        return new self(
            noWildEncounters: true,
        );
    }

    public static function activeSurvey(): self
    {
        return new self(
            activeSurvey: true,
        );
    }

    public static function success(): self
    {
        return new self();
    }

    private function __construct(
        private readonly bool $noWildEncounters = false,
        private readonly bool $activeSurvey = false,
    ) {}

    public function hasNoWildEncounters(): bool
    {
        return $this->noWildEncounters;
    }

    public function hasActiveSurvey(): bool
    {
        return $this->activeSurvey;
    }

    public function wasSuccessful(): bool
    {
        return !$this->noWildEncounters
            && !$this->activeSurvey;
    }
}
