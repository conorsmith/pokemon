<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\ViewModels;

final class ActiveSurveyVm
{
    public function __construct(
        public readonly SurveyTimeVm $length,
        public readonly EncounterTypeVm $encounterType,
    ) {}
}
