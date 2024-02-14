<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

use ConorSmith\Pokemon\Location\Domain\Location;
use ConorSmith\Pokemon\Location\Domain\Survey;
use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\Domain\SurveyResult;
use ConorSmith\Pokemon\Location\ViewModels\EncounterTypeVm;
use ConorSmith\Pokemon\Location\ViewModels\SurveyTimeVm;
use ConorSmith\Pokemon\Location\ViewModels\SurveyRecordVm;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTableEntry;
use ConorSmith\Pokemon\SharedKernel\Queries\PokemonIsRegisteredQuery;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\WildEncounterConfigRepository;

final class ShowSurveyRecord
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly SurveyRepository $surveyRepository,
        private readonly PokemonIsRegisteredQuery $pokemonIsRegisteredQuery,
    ) {}

    public function run(Location $location, string $encounterType): ShowSurveyRecordResult
    {
        $config = $this->wildEncounterConfigRepository->findWildEncounters($location->id);

        if (!$config->hasTable($encounterType)) {
            return ShowSurveyRecordResult::invalidEncounterType();
        }

        $survey = $this->surveyRepository->findForLocationAndEncounterType($location->id, $encounterType);

        if (is_null($survey)) {
            $survey = Survey::blank($location->id, $encounterType);

        } elseif ($survey->isComplete) {
            $surveyResults = [];

            /** @var WildEncounterTableEntry $entry */
            foreach ($config->getTable($encounterType)->entries as $entry) {
                $surveyResults[] = new SurveyResult(
                    $entry->pokedexNumber,
                    $entry->form,
                    $entry->weight,
                );
            }

            $survey = $survey->overwriteResults($surveyResults);
        }

        $resultViewModels = [];

        if ($survey->hasResults()) {

            $mostSightings = $survey->getMostSightings();

            /** @var SurveyResult $surveyResult */
            foreach ($survey->getSortedResultsFromMostSighted() as $surveyResult) {
                $pokedexEntry = $this->pokedexConfigRepository->find($surveyResult->pokedexNumber);

                $resultViewModels[] = (object) [
                    'name'         => $pokedexEntry['name'],
                    'form'         => $surveyResult->form,
                    'imageUrl'     => SharedViewModelFactory::createPokemonImageUrl($surveyResult->pokedexNumber, $surveyResult->form),
                    'isRegistered' => $this->pokemonIsRegisteredQuery->run($surveyResult->pokedexNumber, $surveyResult->form),
                    'width'        => $surveyResult->sightings / $mostSightings * 100,
                ];
            }

        }

        return ShowSurveyRecordResult::show(new SurveyRecordVm(
            SurveyTimeVm::fromDomain($survey->cumulativeTime),
            EncounterTypeVm::fromDomain($encounterType),
            $survey->hasResults(),
            $survey->isComplete,
            $resultViewModels
        ));
    }
}
