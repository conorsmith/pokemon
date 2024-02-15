<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class ActiveSurveyVm
{
    public function __construct(
        public readonly string $startedAt,
        public readonly SurveyTimeVm $currentLength,
        public readonly SurveyTimeVm $cumulativeLength,
        public readonly EncounterTypeVm $encounterType,
    ) {}
}
