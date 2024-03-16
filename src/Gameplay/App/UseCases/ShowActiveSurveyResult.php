<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ActiveSurveyVm;
use LogicException;

final class ShowActiveSurveyResult
{
    public static function noActiveSurvey(): self
    {
        return new self();
    }

    public static function show(ActiveSurveyVm $viewModel): self
    {
        return new self(
            viewModel: $viewModel
        );
    }

    private function __construct(
        private readonly ?ActiveSurveyVm $viewModel = null,
    ) {}

    public function hasActiveSurvey(): bool
    {
        return !is_null($this->viewModel);
    }

    public function getViewModel(): ActiveSurveyVm
    {
        if (is_null($this->viewModel)) {
            throw new LogicException();
        }

        return $this->viewModel;
    }
}
