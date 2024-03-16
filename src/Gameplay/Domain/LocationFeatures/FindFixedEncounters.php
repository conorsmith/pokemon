<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use Carbon\CarbonImmutable;
use Carbon\CarbonTimeZone;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEvent;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEventRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Location;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use DateTimeImmutable;
use LogicException;

final class FindFixedEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly FixedEncounterCaptureEventRepository $fixedEncounterCaptureEventRepository,
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly FixedEncounterConfigRepository $fixedEncounterConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
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
                    && !$this->isRegionCompleteInPokedex($configEntry['unlock'])
                ) {
                    continue;
                }

                $totalRegisteredPokemon = count(array_filter(
                    $this->pokedexEntryRepository->all(),
                    fn (PokemonEntry $entry) => $entry->isRegistered,
                ));

                if ($totalRegisteredPokemon < $configEntry['unlock']) {
                    continue;
                }
            }

            $canBattle = true;

            $lastCaught = $this->findLastTimeFixedEncounterPokemonWasCaptured($configEntry['id']);

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
        $highestRankedBadge = $this->gymBadgeRepository->findHighestRanked();

        return $highestRankedBadge->levelLimit();
    }

    private function isRegionCompleteInPokedex(RegionId $regionId): bool
    {
        $pokedexRegionRanges = match ($regionId) {
            RegionId::KANTO  => [1, 150],
            RegionId::JOHTO  => [152, 250],
            RegionId::HOENN  => [252, 384],
            RegionId::SINNOH => [387, 488],
            RegionId::UNOVA  => [495, 646],
            RegionId::KALOS  => [650, 718],
            RegionId::ALOLA  => [[722, 800], [803, 806]],
            RegionId::GALAR  => [[810, 892], [894, 905]],
            RegionId::PALDEA => [906, 1010],
        };

        if (is_integer($pokedexRegionRanges[0])) {
            $pokedexRegionRanges = [$pokedexRegionRanges];
        }

        $requiredPokedexNumbers = [];

        foreach ($pokedexRegionRanges as $range) {
            $requiredPokedexNumbers = array_merge($requiredPokedexNumbers, range($range[0], $range[1]));
        }

        $entries = $this->pokedexEntryRepository->all();

        $registeredPokedexNumbers = array_map(
            fn(PokemonEntry $entry) => $entry->pokedexNumber,
            array_filter(
                $entries,
                fn(PokemonEntry $entry) => $entry->isRegistered,
            ),
        );

        $missingPokedexNumbers = array_diff($requiredPokedexNumbers, $registeredPokedexNumbers);

        return count($missingPokedexNumbers) === 0;
    }

    private function findLastTimeFixedEncounterPokemonWasCaptured(string $fixedEncounterId): ?DateTimeImmutable
    {
        /** @var FixedEncounterCaptureEvent[] $events */
        $events = $this->fixedEncounterCaptureEventRepository->findForPokemonInReverseChronologicalOrder(
            $fixedEncounterId,
        );

        if (count($events) === 0) {
            return null;
        }

        return $events[0]->capturedAt;
    }
}