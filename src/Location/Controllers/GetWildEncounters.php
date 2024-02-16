<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindWildEncounters;
use ConorSmith\Pokemon\Location\Domain\Location;
use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\Domain\WildEncounters;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\Repositories\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
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
use RuntimeException;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetWildEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly ObtainedGiftPokemonRepository $obtainedGiftPokemonRepository,
        private readonly SurveyRepository $surveyRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly FindWildEncounters $findWildEncounters,
        private readonly AreaIsClearedQuery $areaIsClearedQuery,
        private readonly HighestRankedGymBadgeQuery $highestRankedGymBadgeQuery,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
        private readonly TrainerHasBeenBeatenQuery $trainerHasBeenBeatenQuery,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation->id);

        if (!$features->hasPokemon()) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $wildEncounters = $this->findWildEncounters->find($currentLocation->id);
        $surveys = [];
        if (!is_null($wildEncounters)) {
            $surveys = $this->findSurveys($currentLocation, $wildEncounters);
        }

        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($currentLocation->id);

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/WildEncounters.php", [
            'currentLocation'   => $currentLocationViewModel,
            'canEncounter'      => true,
            'pokeballs'         => $bag->countAllPokeBalls(),
            'ovalCharms'        => $bag->count(ItemId::OVAL_CHARM),
            'hasWildEncounters' => $features->hasWildEncounters,
            'wildEncounters'    => $wildEncounters ? $this->createWildEncountersViewModels($wildEncounters, $surveys) : [],
            'hasGiftPokemon'    => $features->hasGiftPokemon,
            'giftPokemon'       => $this->createGiftPokemonViewModels(
                $this->locationConfigRepository->findLocation($currentLocation->id),
                $giftPokemonConfigEntries,
            ),
            'navigationBar'     => $navigationBarVm,
        ]));
    }

    private function createWildEncountersViewModels(WildEncounters $wildEncounters, array $surveys): array
    {
        $viewModels = [];

        foreach (EncounterType::ALL as $encounterType) {
            if ($wildEncounters->includes($encounterType)) {
                $viewModels[] = (object) [
                    'encounterType'  => $encounterType,
                    'classes'        => match ($encounterType) {
                        EncounterType::WALKING    => "fas fa-shoe-prints",
                        EncounterType::SURFING    => "fas fa-water",
                        EncounterType::FISHING    => "fas fa-fish",
                        EncounterType::ROCK_SMASH => "fab fa-sith",
                        EncounterType::HEADBUTT   => "fas fa-tree",
                        default                   => throw new RuntimeException(),
                    },
                    'surveyStarted'  => !is_null($surveys[$encounterType]),
                    'surveyComplete' => !is_null($surveys[$encounterType]) && $surveys[$encounterType]->isComplete,
                ];
            }
        }

        return $viewModels;
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

    private function findLevelLimit(): int
    {
        $highestRankedBadge = $this->highestRankedGymBadgeQuery->run();

        return $highestRankedBadge->levelLimit();
    }

    private function findSurveys(Location $location, WildEncounters $wildEncounters): array
    {
        $surveys = [];

        foreach (EncounterType::ALL as $encounterType) {
            if ($wildEncounters->includes($encounterType)) {
                $surveys[$encounterType] = $this->surveyRepository->findForLocationAndEncounterType(
                    $location->id,
                    $encounterType,
                );
            }
        }

        return $surveys;
    }
}
