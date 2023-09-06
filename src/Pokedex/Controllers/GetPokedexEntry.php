<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Controllers;

use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Pokedex\Domain\EncounterLocation;
use ConorSmith\Pokemon\Pokedex\Domain\EvolutionaryBranch;
use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\EvolutionaryLineRepository;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\ViewModelFactory;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
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
        private readonly EvolutionaryLineRepository $evolutionaryLineRepository,
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

        $evolutionaryLine = $this->evolutionaryLineRepository->find($pokedexNumber);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Entry.php", [
            'pokemon'            => ViewModelFactory::createPokemonViewModel($entry, $config),
            'encounterLocations' => array_map(
                fn(EncounterLocation $encounterLocation) => self::createEncounterLocationViewModel(
                    $encounterLocation,
                    $this->locationConfigRepository->findLocation($encounterLocation->locationId),
                ),
                $encounterLocations,
            ),
            'evolutions' => $this->createVmsForEvolutionaryLine($evolutionaryLine->getRootBranch()),
        ]));
    }

    private function createVmsForEvolutionaryLine(EvolutionaryBranch $evolutionaryBranch): array
    {
        $vms = [];

        while ($evolutionaryBranch->hasDescendants()) {
            if ($evolutionaryBranch->hasASingleDescendant()) {

                $entry = $this->pokedexEntryRepository->find($evolutionaryBranch->getPokedexNumber());
                $config = $this->pokedexConfigRepository->find($evolutionaryBranch->getPokedexNumber());

                $vms[] = (object) [
                    'type' => "pokemon",
                    'pokemon' => ViewModelFactory::createPokemonViewModel($entry, $config),
                    'isRegistered' => $entry->isRegistered,
                ];

                $vms[] = (object)[
                    'type'    => "evolution",
                    'trigger' => $this->createEvolutionViewModel(
                        $evolutionaryBranch->getFirstBranch()->getPokedexNumber(),
                        $config['evolutions'][$evolutionaryBranch->getFirstBranch()->getPokedexNumber()],
                    ),
                ];

                $evolutionaryBranch = $evolutionaryBranch->getFirstBranch();

                if (!$evolutionaryBranch->hasDescendants()) {
                    $entry = $this->pokedexEntryRepository->find($evolutionaryBranch->getPokedexNumber());
                    $config = $this->pokedexConfigRepository->find($evolutionaryBranch->getPokedexNumber());

                    $vms[] = (object)[
                        'type'         => "pokemon",
                        'pokemon'      => ViewModelFactory::createPokemonViewModel($entry, $config),
                        'isRegistered' => $entry->isRegistered,
                    ];
                }
            } else {
                /** @var EvolutionaryBranch $descendantEvolutionaryBranch */
                foreach ($evolutionaryBranch->getAllBranches() as $descendantEvolutionaryBranch) {
                    $vms[] = (object) [
                        'type' => "branch",
                        'vms' => $this->createVmsForEvolutionaryLine(new EvolutionaryBranch([
                            'pokedexNumber' => $evolutionaryBranch->getPokedexNumber(),
                            'descendants' => [$descendantEvolutionaryBranch->data],
                        ])),
                    ];
                }
                return $vms;
            }
        }

        return $vms;
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
                        0,
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
                default => throw new LogicException(),
            },
            'encounterTypeIcon' => match ($encounterLocation->encounterType) {
                EncounterType::WALKING => "fas fa-shoe-prints",
                EncounterType::SURFING => "fas fa-water",
                EncounterType::FISHING => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
                default => throw new LogicException(),
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
                        default => throw new LogicException(),
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
                        default => throw new LogicException(),
                    },
                ];
            } elseif (array_key_exists('sex', $evolutionConfig)) {
                $trigger = (object) [
                    'type' => "item-sex",
                    'item' => $entry->isRegistered ? str_replace(" ", "&nbsp;", $itemConfig['name']) : "???",
                    'sex' => match ($evolutionConfig['sex']) {
                        Sex::FEMALE => "female",
                        Sex::MALE => "male",
                        default => throw new LogicException(),
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
                        default => throw new LogicException(),
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
                    default => throw new LogicException(),
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
        $pokedexRegionRanges[RegionId::KANTO]  = [1, 151];
        $pokedexRegionRanges[RegionId::JOHTO]  = [152, 251];
        $pokedexRegionRanges[RegionId::HOENN]  = [252, 386];
        $pokedexRegionRanges[RegionId::SINNOH] = [387, 493];
        $pokedexRegionRanges[RegionId::UNOVA]  = [494, 649];
        $pokedexRegionRanges[RegionId::KALOS]  = [650, 721];
        $pokedexRegionRanges[RegionId::ALOLA]  = [722, 809];
        $pokedexRegionRanges[RegionId::GALAR]  = [810, 905];
        $pokedexRegionRanges[RegionId::PALDEA] = [906, 1010];

        foreach ($pokedexRegionRanges as $region => $range) {
            for ($i = $range[0]; $i <= $range[1]; $i++) {
                if ($i == $pokedexNumber) {
                    return $region;
                }
            }
        }

        throw new LogicException;
    }
}
