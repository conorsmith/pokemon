<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

use ConorSmith\Pokemon\Location\ViewModels\SurveyRecordVm;
use LogicException;

final class ShowSurveyRecordResult
{
    public static function invalidEncounterType(): self
    {
        return new self();
    }

    public static function show(SurveyRecordVm $surveyVm): self
    {
        return new self(
            viewModel: $surveyVm
        );
    }

    private function __construct(
        private readonly ?SurveyRecordVm $viewModel = null,
    ) {}

    public function failed(): bool
    {
        return is_null($this->viewModel);
    }

    public function getViewModel(): SurveyRecordVm
    {
        if (is_null($this->viewModel)) {
            throw new LogicException();
        }

        return $this->viewModel;
    }
}
