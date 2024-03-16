<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\Survey;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyResult;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTable;
use ConorSmith\Pokemon\SharedKernel\Config\WildEncounterTableEntry;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use Exception;
use Ramsey\Uuid\Uuid;

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

        $perfectSurvey = self::createPerfectSurvey(
            $survey->locationId,
            $config->getTable($survey->encounterType),
        );

        for ($i = 0; $i < $encounters; $i++) {
            $encounter = self::randomlySelectEntry($config->getTable($survey->encounterType));

            $survey = $survey->addEncounter($encounter->pokedexNumber, $encounter->form);

            if ($survey->matches($perfectSurvey)) {
                $survey = $survey->complete();
                break;
            }
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

    private static function createPerfectSurvey(string $locationId, WildEncounterTable $table): Survey
    {
        $results = [];

        /** @var WildEncounterTableEntry $entry */
        foreach ($table->entries as $entry) {
            $results[] = new SurveyResult(
                $entry->pokedexNumber,
                $entry->form,
                $entry->weight,
            );
        }

        return new Survey(
            Uuid::uuid4()->toString(),
            $locationId,
            $table->encounterType,
            true,
            false,
            CarbonImmutable::now("Europe/Dublin"),
            0,
            $results,
        );
    }
}
