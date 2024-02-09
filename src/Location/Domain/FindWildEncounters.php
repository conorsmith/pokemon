<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\WildEncounterConfigRepository;

final class FindWildEncounters
{
    public function __construct(
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
    ) {}

    public function find(string $locationId): ?WildEncounters
    {
        $config = $this->wildEncounterConfigRepository->findWildEncounters($locationId);

        if (is_null($config)) {
            return null;
        }

        return new WildEncounters(
            isset($config[EncounterType::WALKING]),
            isset($config[EncounterType::SURFING]),
            isset($config[EncounterType::FISHING]),
            isset($config[EncounterType::ROCK_SMASH]),
            isset($config[EncounterType::HEADBUTT]),
        );
    }
}
