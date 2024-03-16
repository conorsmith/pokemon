<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Location;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\FormEntry;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\Survey;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyResult;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\EncounterTypeVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\SurveyTimeVm;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\SurveyRecordVm;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTableEntry;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\WildEncounterConfigRepository;

final class ShowSurveyRecord
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly SurveyRepository $surveyRepository,
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
                    'isRegistered' => $this->isPokemonRegisteredInPokedex($surveyResult->pokedexNumber, $surveyResult->form),
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

    private function isPokemonRegisteredInPokedex(string $pokedexNumber, ?string $form): bool
    {
        $entry = $this->pokedexEntryRepository->find($pokedexNumber);

        if (!$entry->isRegistered) {
            return false;
        }

        if (is_null($form)) {
            return true;
        }

        if (count($entry->forms) === 0) {
            return true;
        }

        /** @var FormEntry $formEntry */
        foreach ($entry->forms as $formEntry) {
            if ($formEntry->id === $form
                && $formEntry->isRegistered
            ) {
                return true;
            }
        }

        return false;
    }
}
