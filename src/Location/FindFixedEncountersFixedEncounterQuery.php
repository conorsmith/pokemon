<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location;

use ConorSmith\Pokemon\Location\Domain\FindFixedEncounters;
use ConorSmith\Pokemon\Location\Domain\FixedEncounter;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\FixedEncounterQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\FixedEncounterResult;

final class FindFixedEncountersFixedEncounterQuery implements FixedEncounterQuery
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly FindFixedEncounters $findFixedEncounters,
    ) {}

    public function run(string $locationId, string $pokedexNumber): ?FixedEncounterResult
    {
        $location = $this->locationRepository->find($locationId);

        $encounters = $this->findFixedEncounters->findEncounters($location);

        /** @var FixedEncounter $encounter */
        foreach ($encounters as $encounter) {
            if ($encounter->pokedexNumber === $pokedexNumber) {
                return new FixedEncounterResult(
                    $encounter->pokedexNumber,
                    null,
                    false,
                    false,
                    $encounter->level,
                    $encounter->canBattle,
                );
            }
        }

        $legendaryEncounters = $this->findFixedEncounters->findLegendaries($location);

        /** @var FixedEncounter $encounter */
        foreach ($legendaryEncounters as $encounter) {
            if ($encounter->pokedexNumber === $pokedexNumber) {
                return new FixedEncounterResult(
                    $encounter->pokedexNumber,
                    null,
                    false,
                    true,
                    $encounter->level,
                    $encounter->canBattle,
                );
            }
        }

        return null;
    }
}
