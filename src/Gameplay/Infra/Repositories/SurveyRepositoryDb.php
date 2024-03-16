<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\Survey;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyResult;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use RuntimeException;

final class SurveyRepositoryDb implements SurveyRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function findForLocationAndEncounterType(string $locationId, string $encounterType): ?Survey
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM surveys
            WHERE instance_id = :instanceId
                AND location_id = :locationId
                AND encounter_type = :encounterType
        ", [
            'instanceId'    => $this->instanceId->value,
            'locationId'    => $locationId,
            'encounterType' => $encounterType,
        ]);

        if ($row === false) {
            return null;
        }

        return $this->createSurvey($row);
    }

    public function findActive(): ?Survey
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM surveys
            WHERE instance_id = :instanceId
                AND in_progress = 1
        ", [
            'instanceId'    => $this->instanceId->value,
        ]);

        if (count($rows) === 0) {
            return null;
        }

        if (count($rows) > 1) {
            throw new RuntimeException();
        }

        $row = $rows[0];

        return $this->createSurvey($row);
    }

    private function createSurvey(array $row): Survey
    {
        return new Survey(
            $row['id'],
            $row['location_id'],
            $row['encounter_type'],
            $row['is_complete'] === 1,
            $row['in_progress'] === 1,
            CarbonImmutable::createFromFormat("Y-m-d H:i:s", $row['started_at'], "Europe/Dublin"),
            intval($row['cumulative_time']),
            is_null($row['results'])
                ? []
                : array_map(
                    fn(array $object) => new SurveyResult(
                        $object['pokedexNumber'],
                        $object['form'],
                        $object['sightings'],
                    ),
                    json_decode($row['results'], true),
                ),
        );
    }

    public function save(Survey $survey): void
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM surveys
            WHERE instance_id = :instanceId
                AND id = :id
        ", [
            'instanceId' => $this->instanceId->value,
            'id'         => $survey->id,
        ]);

        if ($row === false) {
            $this->db->insert("surveys", [
                'id'              => $survey->id,
                'instance_id'     => $this->instanceId->value,
                'location_id'     => $survey->locationId,
                'encounter_type'  => $survey->encounterType,
                'is_complete'     => $survey->isComplete ? 1 : 0,
                'in_progress'     => $survey->inProgress ? 1 : 0,
                'started_at'      => $survey->startedAt->format("Y-m-d H:i:s"),
                'cumulative_time' => $survey->cumulativeTime,
                'results'         => json_encode(array_map(
                    fn(SurveyResult $result) => [
                        'pokedexNumber' => $result->pokedexNumber,
                        'form'          => $result->form,
                        'sightings'     => $result->sightings,
                    ],
                    $survey->results,
                )),
            ]);
        } else {
            $this->db->update("surveys", [
                'location_id'     => $survey->locationId,
                'encounter_type'  => $survey->encounterType,
                'is_complete'     => $survey->isComplete ? 1 : 0,
                'in_progress'     => $survey->inProgress ? 1 : 0,
                'started_at'      => $survey->startedAt->format("Y-m-d H:i:s"),
                'cumulative_time' => $survey->cumulativeTime,
                'results'         => json_encode(array_map(
                    fn(SurveyResult $result) => [
                        'pokedexNumber' => $result->pokedexNumber,
                        'form'          => $result->form,
                        'sightings'     => $result->sightings,
                    ],
                    $survey->results,
                )),
            ], [
                'id'             => $survey->id,
                'instance_id'    => $this->instanceId->value,
            ]);
        }
    }
}
