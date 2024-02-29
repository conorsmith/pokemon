<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\Location\Domain\Features;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FindTrainers;
use ConorSmith\Pokemon\Location\Domain\FindWildEncounters;
use ConorSmith\Pokemon\Location\Domain\Trainer;
use ConorSmith\Pokemon\Location\Domain\WildEncounters;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Queries\RegionalVictoryQuery;
use ConorSmith\Pokemon\TemplateEngine;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetMap
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
        private readonly FindFeatures $findFeatures,
        private readonly FindTrainers $findTrainers,
        private readonly FindWildEncounters $findWildEncounters,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();

        $eliteFourConfig = $this->eliteFourConfigRepository->findInLocation($currentLocation->id);

        $currentLocationViewModel = $this->viewModelFactory->createLocation(
            $currentLocation,
        );

        $features = $this->findFeatures->find($currentLocation);

        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Map.php", [
            'currentLocation' => $currentLocationViewModel,
            'hallOfFame'      => $this->createHallOfFameViewModel(
                $eliteFourConfig,
            ),
            'map'             => self::createMapViewModel($currentLocation->id),
            'navigationBar'   => $navigationBarVm,
            'summary'         => $this->createLocationSummaryViewModel(
                $features,
                $this->findTrainers->find($currentLocation->id),
                $this->findWildEncounters->find($currentLocation->id),
            ),
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

    private function createLocationSummaryViewModel(
        Features $features,
        array $trainers,
        ?WildEncounters $wildEncounters
    ): stdClass {
        return (object) [
            'isShown'  => true,
            'trainers' => (object) [
                'isShown' => count($trainers) > 0,
                'beaten'  => count(array_filter(
                    $trainers,
                    fn(Trainer $trainer) => $trainer->playerHasBeaten(),
                )),
                'total'   => count($trainers),
            ],
            'pokemon'  => (object) [
                'walking'   => $wildEncounters && $wildEncounters->includesWalking,
                'surfing'   => $wildEncounters && $wildEncounters->includesSurfing,
                'fishing'   => $wildEncounters && $wildEncounters->includesFishing,
                'rockSmash' => $wildEncounters && $wildEncounters->includesRockSmash,
                'headbutt'  => $wildEncounters && $wildEncounters->includesHeadbutt,
                'gift'      => $features->hasGiftPokemon,
                'legendary' => $features->hasLegendaryEncounters,
            ],
        ];
    }
}
