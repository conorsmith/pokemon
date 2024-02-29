<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\PokedexRegionIsCompleteQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\HighestRankedGymBadgeQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeFixedEncounterPokemonWasCapturedQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use DateTimeImmutable;
use LogicException;

final class FindFixedEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly FixedEncounterConfigRepository $fixedEncounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly LastTimeFixedEncounterPokemonWasCapturedQuery $lastTimeFixedEncounterPokemonWasCapturedQuery,
        private readonly PokedexRegionIsCompleteQuery $pokedexRegionIsCompleteQuery,
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
    ) {}

    public function findEncounters(Location $location): array
    {
        $configEntries = $this->fixedEncounterConfigRepository->findInLocation($location->id);

        if (count($configEntries) === 0) {
            return [];
        }

        $encounters = [];

        /** @var array $configEntry */
        foreach ($configEntries as $configEntry) {

            $canBattle = true;

            $lastCaught = $this->lastTimeFixedEncounterPokemonWasCapturedQuery->run($location->id, $configEntry['pokemon']);

            if ($this->pokemonHasBeenCapturedTooRecently($lastCaught)) {
                $canBattle = false;
            }

            $bag = $this->bagRepository->find();

            if (!$bag->hasAnyPokeBall()) {
                $canBattle = false;
            }

            if (!$bag->has(ItemId::OVAL_CHARM)) {
                $canBattle = false;
            }

            $levelLimit = $this->findLevelLimit();

            if ($configEntry['level'] > $levelLimit) {
                $canBattle = false;
            }

            $regionalLevelOffset = match ($location->region) {
                RegionId::KANTO => 0,
                RegionId::JOHTO => 50,
                RegionId::HOENN => 100,
                default         => throw new LogicException(),
            };

            $encounters[] = new FixedEncounter(
                $configEntry['pokemon'],
                $configEntry['level'] + $regionalLevelOffset,
                $canBattle,
                $lastCaught,
            );
        }

        return $encounters;
    }

    public function findLegendaries(Location $location): array
    {
        $legendaryConfigs = $this->findConfigEntries($location->id);

        if (count($legendaryConfigs) === 0) {
            return [];
        }

        $legendaryEncounters = [];

        /** @var array $legendaryConfig */
        foreach ($legendaryConfigs as $legendaryConfig) {

            if ($legendaryConfig['unlock'] instanceof RegionId
                && !$this->pokedexRegionIsCompleteQuery->run($legendaryConfig['unlock'])
            ) {
                continue;
            }

            if ($this->totalRegisteredPokemonQuery->run() < $legendaryConfig['unlock']) {
                continue;
            }

            $canBattle = true;

            $lastCaught = $this->lastTimeFixedEncounterPokemonWasCapturedQuery->run($location->id, $legendaryConfig['pokemon']);

            if ($this->legendaryHasBeenCapturedTooRecently($lastCaught)) {
                $canBattle = false;
            }

            $bag = $this->bagRepository->find();

            if (!$bag->hasAnyPokeBall()) {
                $canBattle = false;
            }

            if (!$bag->has(ItemId::OVAL_CHARM)) {
                $canBattle = false;
            }

            $levelLimit = $this->findLevelLimit();

            if ($legendaryConfig['level'] > $levelLimit) {
                $canBattle = false;
            }

            $regionalLevelOffset = match ($location->region) {
                RegionId::KANTO => 0,
                RegionId::JOHTO => 50,
                RegionId::HOENN => 100,
                default         => throw new LogicException(),
            };

            $legendaryEncounters[] = new FixedEncounter(
                $legendaryConfig['pokemon'],
                $legendaryConfig['level'] + $regionalLevelOffset,
                $canBattle,
                $lastCaught,
            );
        }

        return $legendaryEncounters;
    }

    private function findConfigEntries(string $locationId): array
    {
        $legendariesConfig = require __DIR__ . "/../../Config/Legendaries.php";

        $filteredConfigs = [];

        foreach ($legendariesConfig as $config) {
            if ($config['location'] instanceof RegionId
                && $this->encounterRoamingLegendary($locationId, $config)
            ) {
                $filteredConfigs[] = $config;
            } elseif ($config['location'] === $locationId) {
                $filteredConfigs[] = $config;
            }
        }

        return $filteredConfigs;
    }

    private function encounterRoamingLegendary(string $currentLocationId, array $legendaryConfig): bool
    {
        RandomNumberGenerator::setSeed(crc32($legendaryConfig['pokemon'] . date("Y-m-d")));

        $locations = $this->locationConfigRepository->findAllLocationsInRegion($legendaryConfig['location']);

        $roamingLocation = $locations[RandomNumberGenerator::generateInRange(0, count($locations) - 1)];

        RandomNumberGenerator::unsetSeed();

        return $currentLocationId === $roamingLocation['id'];
    }

    private function pokemonHasBeenCapturedTooRecently(?DateTimeImmutable $lastTime): bool
    {
        if (is_null($lastTime)) {
            return false;
        }

        $oneWeekAfterLastTime = (new CarbonImmutable($lastTime))->addWeek();
        $now = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        return $oneWeekAfterLastTime > $now;
    }

    private function legendaryHasBeenCapturedTooRecently(?DateTimeImmutable $lastTime): bool
    {
        if (is_null($lastTime)) {
            return false;
        }

        $oneMonthAfterLastTime = (new CarbonImmutable($lastTime))->addMonth();
        $now = CarbonImmutable::today(new CarbonTimeZone("Europe/Dublin"));

        return $oneMonthAfterLastTime > $now;
    }

    private function findLevelLimit(): int
    {
        $highestRankedBadge = $this->highestRankedGymBadgeQuery->run();

        return $highestRankedBadge->levelLimit();
    }
}