<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

final class FinishSurveyingPokemonResult
{
    public static function noActiveSurvey(): self
    {
        return new self(
            noActiveSurvey: true,
        );
    }

    public static function finished(bool $isComplete): self
    {
        return new self(
            isComplete: $isComplete,
        );
    }

    private function __construct(
        private readonly bool $noActiveSurvey = false,
        private readonly bool $isComplete = false,
    ) {}

    public function hasNoActiveSurvey(): bool
    {
        return $this->noActiveSurvey;
    }

    public function surveyIsComplete(): bool
    {
        return $this->isComplete;
    }
}
