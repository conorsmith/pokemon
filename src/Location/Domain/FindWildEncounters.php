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

        if (!$config->hasTables()) {
            return null;
        }

        return new WildEncounters(
            $config->hasTable(EncounterType::WALKING),
            $config->hasTable(EncounterType::SURFING),
            $config->hasTable(EncounterType::FISHING),
            $config->hasTable(EncounterType::ROCK_SMASH),
            $config->hasTable(EncounterType::HEADBUTT),
        );
    }
}
