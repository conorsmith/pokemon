<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Controllers;

use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Pokedex\Domain\EncounterLocation;
use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\ViewModelFactory;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\RegionIsLockedQuery;
use ConorSmith\Pokemon\TemplateEngine;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use WeakMap;

final class GetPokedexEntry
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly RegionIsLockedQuery $regionIsLockedQuery,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokedexNumber = $args['number'];

        $entry = $this->pokedexEntryRepository->find($pokedexNumber);

        if (!$entry->isRegistered) {
            return new RedirectResponse("/{$args['instanceId']}/pokedex");
        }

        $config = $this->pokedexConfigRepository->find($entry->pokedexNumber);

        $encounterLocations = $this->findEncounterLocations($entry);

        $ancestors = $this->findAncestors($pokedexNumber);
        $descendants = $this->findDescendants($pokedexNumber);

        $evolutionaryLine = $this->mergeAncestorsAndDescendants($ancestors, $descendants);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Entry.php", [
            'pokemon'            => ViewModelFactory::createPokemonViewModel($entry, $config),
            'encounterLocations' => array_map(
                fn(EncounterLocation $encounterLocation) => self::createEncounterLocationViewModel(
                    $encounterLocation,
                    $this->locationConfigRepository->findLocation($encounterLocation->locationId),
                ),
                $encounterLocations,
            ),
            'evolutions' => $this->createVmsForEvolutionaryLine($evolutionaryLine),
        ]));
    }

    private function createVmsForEvolutionaryLine(array $evolutionaryLine): array
    {
        $vms = [];

        while (count($evolutionaryLine['descendants']) > 0) {
            if (count($evolutionaryLine['descendants']) === 1) {

                $entry = $this->pokedexEntryRepository->find($evolutionaryLine['pokedexNumber']);
                $config = $this->pokedexConfigRepository->find($evolutionaryLine['pokedexNumber']);

                $vms[] = (object) [
                    'type' => "pokemon",
                    'pokemon' => ViewModelFactory::createPokemonViewModel($entry, $config),
                    'isRegistered' => $entry->isRegistered,
                ];

                $vms[] = (object)[
                    'type'    => "evolution",
                    'trigger' => $this->createEvolutionViewModel(
                        $evolutionaryLine['descendants'][0]['pokedexNumber'],
                        $config['evolutions'][$evolutionaryLine['descendants'][0]['pokedexNumber']],
                    ),
                ];

                $evolutionaryLine = $evolutionaryLine['descendants'][0];

                if (count($evolutionaryLine['descendants']) === 0) {
                    $entry = $this->pokedexEntryRepository->find($evolutionaryLine['pokedexNumber']);
                    $config = $this->pokedexConfigRepository->find($evolutionaryLine['pokedexNumber']);

                    $vms[] = (object)[
                        'type'         => "pokemon",
                        'pokemon'      => ViewModelFactory::createPokemonViewModel($entry, $config),
                        'isRegistered' => $entry->isRegistered,
                    ];
                }
            } else {
                foreach ($evolutionaryLine['descendants'] as $descendantEvolutionaryLine) {
                    $vms[] = (object) [
                        'type' => "branch",
                        'vms' => $this->createVmsForEvolutionaryLine([
                            'pokedexNumber' => $evolutionaryLine['pokedexNumber'],
                            'descendants' => [$descendantEvolutionaryLine],
                        ]),
                    ];
                }
                return $vms;
            }
        }

        return $vms;
    }

    private function mergeAncestorsAndDescendants(array $ancestors, array $descendants): array
    {
        $ancestors = array_reverse($ancestors);

        foreach ($ancestors as $ancestorPokedexNumber) {
            $descendants = [
                'pokedexNumber' => $ancestorPokedexNumber,
                'descendants' => [$descendants],
            ];
        }

        return $descendants;
    }

    private function findDescendants(string $pokedexNumber): array
    {
        $entry = $this->pokedexConfigRepository->find($pokedexNumber);

        if (!isset($entry['evolutions'])) {
            return [
                'pokedexNumber' => $pokedexNumber,
                'descendants' => [],
            ];
        }

        $descendants = [];

        foreach ($entry['evolutions'] as $descendantPokedexNumber => $evolutionConfig) {
            $descendants[] = $this->findDescendants(strval($descendantPokedexNumber));
        }

        return [
            'pokedexNumber' => $pokedexNumber,
            'descendants' => $descendants,
        ];
    }

    private function findAncestors(string $pokedexNumber): array
    {
        $candidates = [];

        while (!is_null($pokedexNumber)) {
            $pokedexNumber = $this->findPreviousStageOfEvolutionaryLine($pokedexNumber);
            if (!is_null($pokedexNumber)) {
                $candidates[] = $pokedexNumber;
            }
        }

        return array_reverse($candidates);
    }

    private function findPreviousStageOfEvolutionaryLine(string $pokedexNumber): ?string
    {
        foreach ($this->pokedexConfigRepository->all() as $previousStagePokedexNumber => $entry) {
            if (!isset($entry['evolutions'])) {
                continue;
            }

            foreach ($entry['evolutions'] as $evolutionPokedexNumber => $evolutionConfig) {
                if (strval($evolutionPokedexNumber) === $pokedexNumber) {
                    return strval($previousStagePokedexNumber);
                }
            }
        }

        return null;
    }

    private function findEncounterLocations(PokemonEntry $entry): array
    {
        $entryPokedexNumber = intval($entry->pokedexNumber);

        $locations = [];

        foreach ($this->encounterConfigRepository->allByRegion() as $region => $regionEncountersConfig) {
            if ($this->regionIsLockedQuery->run($region)) {
                continue;
            }
            foreach ($regionEncountersConfig as $locationId => $locationEncountersConfig) {
                foreach ($locationEncountersConfig as $encounterType => $encountersConfig) {
                    $totalWeight = array_reduce(
                        $encountersConfig,
                        fn(int $carry, array $config) => !isset($config['weight'])
                            ? array_reduce(
                                $config,
                                fn(int $carry, array $config) => $carry + $config['weight'],
                                0,
                            )
                            : $carry + $config['weight'],
                        0
                    );
                    foreach ($encountersConfig as $encounterPokedexNumber => $config) {
                        if ($encounterPokedexNumber === $entryPokedexNumber) {
                            $weight = !isset($config['weight'])
                                ? array_reduce(
                                    $config,
                                    fn(int $carry, array $config) => $carry + $config['weight'],
                                    0,
                                )
                                : $config['weight'];

                            $locations[] = new EncounterLocation(
                                $locationId,
                                $region,
                                $encounterType,
                                $weight / $totalWeight,
                            );
                        }
                    }
                }
            }
        }

        return $locations;
    }

    private static function createEncounterLocationViewModel(
        EncounterLocation $encounterLocation,
        array $locationConfig,
    ): stdClass {
        return (object) [
            'name' => $locationConfig['name'],
            'section' => $locationConfig['section'] ?? "",
            'region' => match ($encounterLocation->region) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
            },
            'encounterTypeIcon' => match ($encounterLocation->encounterType) {
                EncounterType::WALKING => "fas fa-shoe-prints",
                EncounterType::SURFING => "fas fa-water",
                EncounterType::FISHING => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
            },
            'rarityIcons' => match (true) {
                $encounterLocation->rarity > 0.15 => 3,
                $encounterLocation->rarity > 0.05 => 2,
                default => 1,
            },
        ];
    }

    private function createEvolutionViewModel(string $pokedexNumber, array $evolutionConfig): stdClass
    {
        $region = self::findNativeRegion($pokedexNumber);

        $regionalLevelOffset = match ($region) {
            RegionId::KANTO => 0,
            RegionId::JOHTO => 50,
            RegionId::HOENN => 100,
            RegionId::SINNOH => 150,
            RegionId::UNOVA => 200,
            RegionId::KALOS => 250,
            RegionId::ALOLA => 300,
            RegionId::GALAR => 350,
            RegionId::PALDEA => 400,
        };

        $entry = $this->pokedexEntryRepository->find($pokedexNumber);

        if (array_key_exists('level', $evolutionConfig)) {

            if (array_key_exists('stats', $evolutionConfig)) {
                $trigger = (object) [
                    'type'  => "level-stats",
                    'level' => $entry->isRegistered ? $evolutionConfig['level'] + $regionalLevelOffset : "???",
                    'stats' => match ($evolutionConfig['stats']) {
                        "Physical Attack > Physical Defence" => "greater-than",
                        "Physical Attack < Physical Defence" => "less-than",
                        "Physical Attack = Physical Defence" => "equals",
                    },
                ];
            } elseif (in_array("randomly", $evolutionConfig)) {
                $trigger = (object) [
                    'type'  => "level-randomly",
                    'level' => $entry->isRegistered ? $evolutionConfig['level'] + $regionalLevelOffset : "???",
                ];
            } else {
                $trigger = (object) [
                    'type'  => "level",
                    'level' => $entry->isRegistered ? $evolutionConfig['level'] + $regionalLevelOffset : "???",
                ];
            }

        } elseif (array_key_exists('item', $evolutionConfig)) {
            $itemConfig = $this->itemConfigRepository->find($evolutionConfig['item']);

            if (array_key_exists('time', $evolutionConfig)) {
                $trigger = (object)[
                    'type' => "item-time",
                    'item' => $entry->isRegistered ? str_replace(" ", "&nbsp;", $itemConfig['name']) : "???",
                    'time' => match ($evolutionConfig['time']) {
                        "Full Moon" => "during&nbsp;a&nbsp;full&nbsp;moon",
                    },
                ];
            } elseif (array_key_exists('sex', $evolutionConfig)) {
                $trigger = (object) [
                    'type' => "item-sex",
                    'item' => $entry->isRegistered ? str_replace(" ", "&nbsp;", $itemConfig['name']) : "???",
                    'sex' => match ($evolutionConfig['sex']) {
                        Sex::FEMALE => "female",
                        Sex::MALE => "male",
                    },
                ];
            } else {
                $trigger = (object) [
                    'type' => "item",
                    'item' => $entry->isRegistered ? str_replace(" ", "&nbsp;", $itemConfig['name']) : "???",
                ];
            }

        } elseif ($evolutionConfig === ["friendship"]) {
            $trigger = (object) [
                'type' => "friendship",
            ];

        } elseif (in_array("friendship", $evolutionConfig)) {
            if (array_key_exists('time', $evolutionConfig)) {
                $trigger = (object) [
                    'type' => "friendship-time",
                    'time' => match ($evolutionConfig['time']) {
                        "day"   => "during&nbsp;the&nbsp;day",
                        "night" => "at&nbsp;night",
                    },
                ];
            } elseif (array_key_exists('move', $evolutionConfig)) {
                $trigger = (object) [
                    'type' => "friendship-move",
                ];
            } else {
                throw new LogicException;
            }

        } elseif (array_key_exists('move', $evolutionConfig)) {
            $trigger = (object) [
                'type' => "move",
            ];

        } elseif (array_key_exists('holding', $evolutionConfig)
            && array_key_exists('time', $evolutionConfig)
        ) {
            $itemConfig = $this->itemConfigRepository->find($evolutionConfig['holding']);

            $trigger = (object) [
                'type' => "holding-time",
                'item' => $entry->isRegistered ? str_replace(" ", "&nbsp;", $itemConfig['name']) : "???",
                'time' => match ($evolutionConfig['time']) {
                    "day"   => "during&nbsp;the&nbsp;day",
                    "night" => "at&nbsp;night",
                },
            ];

        } else {
            throw new LogicException;
        }

        return $trigger;
    }

    private static function findNativeRegion(string $pokedexNumber): RegionId
    {
        $pokedexRegionRanges = new WeakMap();
        $pokedexRegionRanges[RegionId::KANTO]  = [1, 150];
        $pokedexRegionRanges[RegionId::JOHTO]  = [152, 250];
        $pokedexRegionRanges[RegionId::HOENN]  = [252, 384];
        $pokedexRegionRanges[RegionId::SINNOH] = [387, 488];
        $pokedexRegionRanges[RegionId::UNOVA]  = [495, 646];
        $pokedexRegionRanges[RegionId::KALOS]  = [650, 718];
        $pokedexRegionRanges[RegionId::ALOLA]  = [[722, 800], [803, 806]];
        $pokedexRegionRanges[RegionId::GALAR]  = [[810, 892], [894, 905]];
        $pokedexRegionRanges[RegionId::PALDEA] = [906, 1010];

        foreach ($pokedexRegionRanges as $region => $ranges) {
            if (is_int($ranges[0])) {
                $ranges = [$ranges];
            }
            foreach ($ranges as $range) {
                for ($i = $range[0]; $i <= $range[1]; $i++) {
                    if ($i == $pokedexNumber) {
                        return $region;
                    }
                }
            }
        }

        throw new LogicException;
    }
}
