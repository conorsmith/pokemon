<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindWildEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\Survey;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;

final class StartSurveyingPokemon
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly SurveyRepository $surveyRepository,
        private readonly FindWildEncounters $findWildEncounters,
    ) {}

    public function run(string $encounterType): StartSurveyingPokemonResult
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();

        $wildEncounters = $this->findWildEncounters->find($currentLocation->id);

        if (is_null($wildEncounters)) {
            return StartSurveyingPokemonResult::noWildEncounters();
        }

        if (!$wildEncounters->includes($encounterType)) {
            return StartSurveyingPokemonResult::noWildEncounters();
        }

        $survey = $this->surveyRepository->findForLocationAndEncounterType($currentLocation->id, $encounterType);

        if (is_null($survey)) {
            $survey = Survey::blank($currentLocation->id, $encounterType);
        }

        if ($survey->inProgress) {
            return StartSurveyingPokemonResult::activeSurvey();
        }

        $survey = $survey->start();

        $this->surveyRepository->save($survey);

        return StartSurveyingPokemonResult::success();
    }
}
