<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\UseCase;

use ConorSmith\Pokemon\Location\Domain\Survey;
use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\Domain\SurveyResult;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTable;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTableEntry;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use Exception;

final class FinishSurveyingPokemon
{
    public function __construct(
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly SurveyRepository $surveyRepository,
    ) {}

    public function run(): FinishSurveyingPokemonResult
    {
        $survey = $this->surveyRepository->findActive();

        if (is_null($survey)) {
            return FinishSurveyingPokemonResult::noActiveSurvey();
        }

        $config = $this->wildEncounterConfigRepository->findWildEncounters($survey->locationId);

        $encounters = $survey->countEncountersInCurrentSession();

        for ($i = 0; $i < $encounters; $i++) {
            $encounter = self::randomlySelectEntry($config->getTable($survey->encounterType));

            $survey = $survey->addEncounter($encounter->pokedexNumber, $encounter->form);
        }

        if ($this->surveyIsComplete($survey, $config->getTable($survey->encounterType))) {
            $survey = $survey->complete();
        }

        $survey = $survey->finish();

        $this->surveyRepository->save($survey);

        return FinishSurveyingPokemonResult::finished($survey->isComplete);
    }

    private static function randomlySelectEntry(WildEncounterTable $table): WildEncounterTableEntry
    {
        $aggregatedWeight = array_reduce(
            $table->entries,
            function ($carry, WildEncounterTableEntry $entry) {
                return $carry + $entry->weight;
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var WildEncounterTableEntry $entry */
        foreach ($table->entries as $entry) {
            $randomlySelectedValue -= $entry->weight;
            if ($randomlySelectedValue <= 0) {
                return $entry;
            }
        }

        throw new Exception;
    }

    private function surveyIsComplete(Survey $survey, WildEncounterTable $table): bool
    {
        if ($survey->cumulativeTime + $survey->currentDuration() < 60 * 60) {
            return false;
        }

        $largestConfiguredWeight = 0;

        /** @var WildEncounterTableEntry $entry */
        foreach ($table->entries as $entry) {
            if ($entry->weight > $largestConfiguredWeight) {
                $largestConfiguredWeight = $entry->weight;
            }
        }

        $mostSightings = 0;

        /** @var SurveyResult $result */
        foreach ($survey->results as $result) {
            if ($result->sightings > $mostSightings) {
                $mostSightings = $result->sightings;
            }
        }

        /** @var WildEncounterTableEntry $entry */
        foreach ($table->entries as $entry) {
            $result = $survey->findResult($entry->pokedexNumber, $entry->form);
            if (is_null($result)) {
                return false;
            }

            $configuredRate = $entry->weight / $largestConfiguredWeight;
            $surveyedRate = $result->sightings / $mostSightings;

            $roundedConfiguredRate = round($configuredRate * 20);
            $roundedSurveyedRate = round($surveyedRate * 20);

            if ($roundedConfiguredRate !== $roundedSurveyedRate) {
                return false;
            }
        }

        return true;
    }
}
