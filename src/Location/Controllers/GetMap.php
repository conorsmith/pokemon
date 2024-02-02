<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FixedEncounter;
use ConorSmith\Pokemon\Location\Domain\FindFixedEncounters;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\Repositories\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Queries\AreaIsClearedQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\HighestRankedGymBadgeQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\RegionalVictoryQuery;
use ConorSmith\Pokemon\SharedKernel\Queries\TrainerHasBeenBeatenQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use LogicException;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetMap
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly BagRepository $bagRepository,
        private readonly ObtainedGiftPokemonRepository $obtainedGiftPokemonRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
        private readonly AreaIsClearedQuery $areaIsClearedQuery,
        private readonly TrainerHasBeenBeatenQuery $trainerHasBeenBeatenQuery,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly FindFeatures $findFeatures,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($currentLocation->id);
        $eliteFourConfig = $this->eliteFourConfigRepository->findInLocation($currentLocation->id);

        $legendaryEncounter = $this->findFixedEncounters->findLegendary(
            $this->locationConfigRepository->findLocation($currentLocation->id)
        );

        $currentLocationViewModel = $this->viewModelFactory->createLocation(
            $currentLocation,
        );

        $features = $this->findFeatures->find($currentLocation->id);

        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Map.php", [
            'canEncounter'    => true,
            'pokeballs'       => $bag->countAllPokeBalls(),
            'ovalCharms'      => $bag->count(ItemId::OVAL_CHARM),
            'currentLocation' => $currentLocationViewModel,
            'legendary'       => $legendaryEncounter
                ? $this->createLegendaryViewModel($legendaryEncounter)
                : null,
            'giftPokemon'     => $this->createGiftPokemonViewModels(
                $this->locationConfigRepository->findLocation($currentLocation->id),
                $giftPokemonConfigEntries,
            ),
            'hallOfFame'      => $this->createHallOfFameViewModel(
                $eliteFourConfig,
            ),
            'map'             => self::createMapViewModel($currentLocation->id),
            'navigationBar'   => $navigationBarVm,
        ]));
    }

    private static function createMapViewModel(string $currentLocation): stdClass
    {
        $mapImageUrl = self::findMapImage($currentLocation);

        return (object) [
            'imageUrl' => $mapImageUrl,
            'class'    => match ($mapImageUrl) {
                "/assets/maps/Kanto_Victory_Road_Map.png" => "map--kanto-victory-road",
                "/assets/maps/Kanto_Route_28_Map.png"     => "map--kanto-johto-border",
                "/assets/maps/Johto_Mt_Silver_Map.png"    => "map--kanto-johto-border",
                "/assets/maps/Kanto_Route_27_Map.png"     => "map--kanto-johto-border",
                "/assets/maps/Kanto_Tohjo_Falls_Map.png"  => "map--kanto-johto-border",
                default                                   => "",
            },
        ];
    }

    private function createLegendaryViewModel(FixedEncounter $fixedEncounter): stdClass
    {
        return (object) [
            'number'          => $fixedEncounter->pokedexNumber,
            'name'            => $this->pokedexConfigRepository->find($fixedEncounter->pokedexNumber)['name'],
            'imageUrl'        => SharedViewModelFactory::createPokemonImageUrl($fixedEncounter->pokedexNumber),
            'level'           => $fixedEncounter->level,
            'canBattle'       => $fixedEncounter->canBattle,
            'lastEncountered' => $fixedEncounter->lastCaptured ? $fixedEncounter->lastCaptured->ago() : "",
        ];
    }

    private function createHallOfFameViewModel(?array $eliteFourConfig): ?stdClass
    {
        if (is_null($eliteFourConfig)) {
            return null;
        }

        if (!$this->regionalVictoryQuery->run($eliteFourConfig['region'])) {
            return null;
        }

        return (object) [
            'region' => strtolower($eliteFourConfig['region']->value),
        ];
    }

    private function findLevelLimit(): int
    {
        $highestRankedBadge = $this->highestRankedGymBadgeQuery->run();

        return $highestRankedBadge->levelLimit();
    }

    private static function findMapImage(string $locationId): ?string
    {
        $mapImages = include __DIR__ . "/../../Config/Maps/Kanto.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        $mapImages = include __DIR__ . "/../../Config/Maps/Johto.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        $mapImages = include __DIR__ . "/../../Config/Maps/Hoenn.php";

        if (array_key_exists($locationId, $mapImages)) {
            return "/assets/maps/" . $mapImages[$locationId];
        }

        return null;
    }

    private function createGiftPokemonViewModels(array $currentLocation, array $giftPokemonConfigEntries): array
    {
        $giftPokemon = [];

        foreach ($giftPokemonConfigEntries as $giftPokemonConfigEntry) {

            $canObtain = true;

            $bag = $this->bagRepository->find();

            if (!$bag->has(ItemId::OVAL_CHARM)) {
                $canObtain = false;
            }

            $levelLimit = $this->findLevelLimit();

            if ($giftPokemonConfigEntry['level'] > $levelLimit) {
                $canObtain = false;
            }

            $obtainedGiftPokemon = $this->obtainedGiftPokemonRepository->findMostRecent(
                $giftPokemonConfigEntry['pokemon'],
                $currentLocation['id'],
            );

            if (!is_null($obtainedGiftPokemon)
                && $obtainedGiftPokemon->isInCooldownWindow()
            ) {
                $canObtain = false;
            }

            if ($canObtain) {
                if (isset($giftPokemonConfigEntry['requirements'])) {
                    foreach ($giftPokemonConfigEntry['requirements'] as $requirementName => $requirementValue) {
                        if ($requirementName === "clear") {
                            $canObtain = $this->areaIsClearedQuery->run($requirementValue);
                        } elseif ($requirementName === "defeat") {
                            $canObtain = $this->trainerHasBeenBeatenQuery->run($requirementValue);
                        } elseif ($requirementName === "victory") {
                            $canObtain = $this->regionalVictoryQuery->run($requirementValue);
                        }
                    }
                }
            }

            if (is_null($obtainedGiftPokemon)) {
                $lastObtained = "";
            } else {
                $lastObtained = $obtainedGiftPokemon->obtainedAt->ago();
            }

            $regionalLevelOffset = match ($currentLocation['region']) {
                RegionId::KANTO => 0,
                RegionId::JOHTO => 50,
                RegionId::HOENN => 100,
                default         => throw new LogicException(),
            };

            $giftPokemon[] = (object) [
                'number'          => $giftPokemonConfigEntry['pokemon'],
                'name'            => $this->pokedexConfigRepository->find($giftPokemonConfigEntry['pokemon'])['name'],
                'imageUrl'        => SharedViewModelFactory::createPokemonImageUrl($giftPokemonConfigEntry['pokemon']),
                'level'           => $giftPokemonConfigEntry['level'] + $regionalLevelOffset,
                'canObtain'       => $canObtain,
                'lastObtained'    => $lastObtained,
            ];
        }

        return $giftPokemon;
    }
}
