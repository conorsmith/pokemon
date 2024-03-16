<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Battle;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFixedEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindWildEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FixedEncounter;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\Location;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\WildEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFeatures;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use LogicException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetObtainablePokemon
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly BattleRepository $battleRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly LocationRepository $locationRepository,
        private readonly ObtainedGiftPokemonRepository $obtainedGiftPokemonRepository,
        private readonly SurveyRepository $surveyRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly FindWildEncounters $findWildEncounters,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation);

        if (!$features->hasPokemon()) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $wildEncounters = $this->findWildEncounters->find($currentLocation->id);
        $surveys = [];
        if (!is_null($wildEncounters)) {
            $surveys = $this->findSurveys($currentLocation, $wildEncounters);
        }

        $location = $this->locationConfigRepository->findLocation($currentLocation->id);

        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($currentLocation->id);

        $fixedEncounters = $this->findFixedEncounters->findInLocation($currentLocation);

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/ObtainablePokemon.php", [
            'currentLocation'    => $currentLocationViewModel,
            'canEncounter'       => true,
            'pokeballs'          => $bag->countAllPokeBalls(),
            'ovalCharms'         => $bag->count(ItemId::OVAL_CHARM),
            'hasWildEncounters'  => $features->hasWildEncounters,
            'wildEncounters'     => $wildEncounters ? $this->createWildEncountersViewModels($wildEncounters, $surveys) : [],
            'hasFixedEncounters' => $features->hasStandardFixedEncounters
                || $features->hasLegendaryFixedEncounters
                || $features->hasGiftPokemon,
            'fixedEncounters'    => $this->createFixedEncounterViewModels($fixedEncounters),
            'giftPokemon'        => $this->createGiftPokemonViewModels(
                $location,
                $giftPokemonConfigEntries,
            ),
            'navigationBar'      => $navigationBarVm,
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
                            $canObtain = $this->isAreaCleared($requirementValue);

                        } elseif ($requirementName === "defeat") {
                            $battle = $this->battleRepository->findForTrainer($requirementValue);
                            $canObtain = !is_null($battle) && $battle->playerHasWon();

                        } elseif ($requirementName === "victory") {
                            $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($requirementValue);
                            $canObtain = !is_null($eliteFourChallenge);
                        }
                    }
                }
            }

            if (is_null($obtainedGiftPokemon)) {
                $lastObtained = "";
            } else {
                $obtainedAt = new CarbonImmutable($obtainedGiftPokemon->obtainedAt);
                $lastObtained = $obtainedAt->ago();
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
        $highestRankedBadge = $this->gymBadgeRepository->findHighestRanked();

        return $highestRankedBadge->levelLimit();
    }

    private function createFixedEncounterViewModels(array $fixedEncounters): array
    {
        $viewModels = [];

        /** @var FixedEncounter $fixedEncounter */
        foreach ($fixedEncounters as $fixedEncounter) {

            if ($fixedEncounter->lastCaptured) {
                $lastCaptured = new CarbonImmutable($fixedEncounter->lastCaptured);
                $lastEncountered = $lastCaptured->ago();
            } else {
                $lastEncountered = "";
            }

            $viewModels[] = (object) [
                'number'          => $fixedEncounter->pokedexNumber,
                'name'            => $this->pokedexConfigRepository->find($fixedEncounter->pokedexNumber)['name'],
                'imageUrl'        => SharedViewModelFactory::createPokemonImageUrl($fixedEncounter->pokedexNumber),
                'isLegendary'     => $fixedEncounter->isLegendary,
                'isShiny'         => $fixedEncounter->isShiny,
                'level'           => $fixedEncounter->level,
                'canBattle'       => $fixedEncounter->canBattle,
                'lastEncountered' => $lastEncountered,
            ];
        }

        return $viewModels;
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

    private function isAreaCleared(string $locationId): bool
    {
        $location = $this->locationConfigRepository->findLocation($locationId);

        if (is_null($location)) {
            $locations = $this->locationConfigRepository->findLocationsInArea($locationId);
        } else {
            $locations = [$location];
        }

        foreach ($locations as $location) {
            $battles = $this->battleRepository->findBattlesInLocation($location['id']);
            /** @var ?Battle $battle */
            foreach ($battles as $battle) {
                if (is_null($battle)) {
                    return false;
                }
                if (!$battle->playerHasWon()) {
                    return false;
                }
            }
        }

        return true;
    }
}
