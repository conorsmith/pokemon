<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\ViewModels\ActiveSurveyVm;
use ConorSmith\Pokemon\Location\ViewModels\EncounterTypeVm;
use ConorSmith\Pokemon\Location\ViewModels\SurveyTimeVm;

final class ShowActiveSurvey
{
    public function __construct(
        public readonly SurveyRepository $surveyRepository,
    ) {}

    public function run(string $encounterType): ShowActiveSurveyResult
    {
        $survey = $this->surveyRepository->findActive();

        if (is_null($survey)) {
            return ShowActiveSurveyResult::noActiveSurvey();
        }

        return ShowActiveSurveyResult::show(new ActiveSurveyVm(
            $survey->startedAt->format("Y-m-d\TH:i:sP"),
            SurveyTimeVm::fromDomain($survey->currentDuration()),
            SurveyTimeVm::fromDomain($survey->cumulativeTime),
            EncounterTypeVm::fromDomain($encounterType),
        ));
    }
}
