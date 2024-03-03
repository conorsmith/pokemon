<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
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
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly LastTimeFixedEncounterPokemonWasCapturedQuery $lastTimeFixedEncounterPokemonWasCapturedQuery,
        private readonly PokedexRegionIsCompleteQuery $pokedexRegionIsCompleteQuery,
        private readonly TotalRegisteredPokemonQuery $totalRegisteredPokemonQuery,
    ) {}

    public function findInLocation(Location $location): array
    {
        $configEntries = array_filter(
            $this->fixedEncounterConfigRepository->all(),
            fn (array $entry) => (
                    $entry['location'] instanceof RegionId
                    && $entry['location'] === $location->region
                    && $this->isRoamingLegendaryInLocation($entry, $location)
                ) || (
                    $entry['location'] === $location->id
                ),
        );

        if (count($configEntries) === 0) {
            return [];
        }

        $encounters = [];

        /** @var array $configEntry */
        foreach ($configEntries as $configEntry) {

            if (isset($configEntry['unlock'])) {
                if ($configEntry['unlock'] instanceof RegionId
                    && !$this->pokedexRegionIsCompleteQuery->run($configEntry['unlock'])
                ) {
                    continue;
                }

                if ($this->totalRegisteredPokemonQuery->run() < $configEntry['unlock']) {
                    continue;
                }
            }

            $canBattle = true;

            $lastCaught = $this->lastTimeFixedEncounterPokemonWasCapturedQuery->run($configEntry['id']);

            $pokedexConfigEntry = $this->pokedexConfigRepository->find($configEntry['pokemon']);

            if (isset($pokedexConfigEntry['isLegendary']) && $pokedexConfigEntry['isLegendary'] === true) {
                if ($this->legendaryHasBeenCapturedTooRecently($lastCaught)) {
                    $canBattle = false;
                }
            } else {
                if ($this->pokemonHasBeenCapturedTooRecently($lastCaught)) {
                    $canBattle = false;
                }
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
                $configEntry['id'],
                $configEntry['pokemon'],
                isset($pokedexConfigEntry['isLegendary']) && $pokedexConfigEntry['isLegendary'] === true,
                isset($configEntry['isShiny']) && $configEntry['isShiny'] === true,
                $configEntry['level'] + $regionalLevelOffset,
                $canBattle,
                $lastCaught,
            );
        }

        return $encounters;
    }

    private function isRoamingLegendaryInLocation(array $entry, Location $location): bool
    {
        RandomNumberGenerator::setSeed(crc32($entry['pokemon'] . date("Y-m-d")));

        $locations = $this->locationConfigRepository->findAllLocationsInRegion($entry['location']);

        $roamingLocation = $locations[RandomNumberGenerator::generateInRange(0, count($locations) - 1)];

        RandomNumberGenerator::unsetSeed();

        return $location->id === $roamingLocation['id'];
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