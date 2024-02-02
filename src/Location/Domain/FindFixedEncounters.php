<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\PokedexRegionIsCompleteQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\HighestRankedGymBadgeQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\LastTimeLegendaryPokemonWasCapturedQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use DateTimeImmutable;
use LogicException;

final class FindFixedEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly LastTimeLegendaryPokemonWasCapturedQuery $lastTimeLegendaryPokemonWasCapturedQuery,
        private readonly PokedexRegionIsCompleteQuery $pokedexRegionIsCompleteQuery,
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
    ) {}

    public function findLegendary(array $location): ?FixedEncounter
    {
        $legendaryConfig = $this->findLegendaryConfig($location['id']);

        if (is_null($legendaryConfig)) {
            return null;
        }

        if ($legendaryConfig['unlock'] instanceof RegionId
            && !$this->pokedexRegionIsCompleteQuery->run($legendaryConfig['unlock'])
        ) {
            return null;
        }

        if ($this->totalRegisteredPokemonQuery->run() < $legendaryConfig['unlock']) {
            return null;
        }

        $canBattle = true;

        $lastCaught = $this->lastTimeLegendaryPokemonWasCapturedQuery->run($legendaryConfig['pokemon']);

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

        $regionalLevelOffset = match ($location['region']) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
            default         => throw new LogicException(),
        };

        return new FixedEncounter(
            $legendaryConfig['pokemon'],
            $legendaryConfig['level'] + $regionalLevelOffset,
            $canBattle,
            $lastCaught,
        );
    }

    private function findLegendaryConfig(string $locationId): ?array
    {
        $legendariesConfig = require __DIR__ . "/../../Config/Legendaries.php";

        foreach ($legendariesConfig as $config) {
            if ($config['location'] instanceof RegionId
                && $this->encounterRoamingLegendary($locationId, $config)
            ) {
                return $config;
            }
            if ($config['location'] === $locationId) {
                return $config;
            }
        }

        return null;
    }

    private function encounterRoamingLegendary(string $currentLocationId, array $legendaryConfig): bool
    {
        RandomNumberGenerator::setSeed(crc32($legendaryConfig['pokemon'] . date("Y-m-d")));

        $locations = $this->locationConfigRepository->findAllLocationsInRegion($legendaryConfig['location']);

        $roamingLocation = $locations[RandomNumberGenerator::generateInRange(0, count($locations) - 1)];

        RandomNumberGenerator::unsetSeed();

        return $currentLocationId === $roamingLocation['id'];
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