<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ActiveSurveyVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\EncounterTypeVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\SurveyTimeVm;

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
