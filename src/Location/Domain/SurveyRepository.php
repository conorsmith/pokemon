<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

interface SurveyRepository
{
    public function findForLocationAndEncounterType(string $locationId, string $encounterType): ?Survey;
    public function findActive(): ?Survey;
    public function save(Survey $survey): void;
}
