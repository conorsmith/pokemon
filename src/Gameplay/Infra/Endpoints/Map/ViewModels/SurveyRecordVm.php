<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels;

final class SurveyRecordVm
{
    public function __construct(
        public readonly SurveyTimeVm $length,
        public readonly EncounterTypeVm $encounterType,
        public readonly bool $hasResults,
        public readonly bool $isComplete,
        public readonly array $results,
    ) {}
}
