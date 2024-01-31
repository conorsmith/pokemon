<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetWildEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $encounters = $this->encounterConfigRepository->findEncounters($currentLocation->id);
        $trainers = $this->trainerConfigRepository->findTrainersInLocation($currentLocation->id);
        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($currentLocation->id);
        $legendaryConfig = $this->findLegendaryConfig($currentLocation->id);
        $eliteFourConfig = self::findEliteFourConfig($currentLocation->id);

        $currentLocationViewModel = $this->viewModelFactory->createLocation(
            $currentLocation,
            $encounters,
            $trainers,
            $giftPokemonConfigEntries,
            $legendaryConfig,
            $eliteFourConfig,
        );

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/WildEncounters.php", [
            'currentLocation' => $currentLocationViewModel,
            'canEncounter'    => true,
            'pokeballs'       => $bag->countAllPokeBalls(),
            'wildPokemon'     => $this->createWildPokemonViewModel($encounters),
        ]));
    }

    private function createWildPokemonViewModel(?array $encounterTables): stdClass
    {
        return (object) [
            'hasEncounters' => !is_null($encounterTables),
            'encounters'    => (object) [
                'walking'   => isset($encounterTables[EncounterType::WALKING]),
                'surfing'   => isset($encounterTables[EncounterType::SURFING]),
                'fishing'   => isset($encounterTables[EncounterType::FISHING]),
                'rockSmash' => isset($encounterTables[EncounterType::ROCK_SMASH]),
                'headbutt'  => isset($encounterTables[EncounterType::HEADBUTT]),
            ],
        ];
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

    private static function findEliteFourConfig(string $locationId): ?array
    {
        $eliteFourConfig = require __DIR__ . "/../../Config/EliteFour.php";

        foreach ($eliteFourConfig as $config) {
            if ($config['location'] === $locationId) {
                return $config;
            }
        }

        return null;
    }
}
