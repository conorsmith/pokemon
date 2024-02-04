<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
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
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetGiftPokemon
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly ObtainedGiftPokemonRepository $obtainedGiftPokemonRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly FindFeatures $findFeatures,
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

        if (!$features->hasGiftPokemon) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($currentLocation->id);

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/GiftPokemon.php", [
            'currentLocation' => $currentLocationViewModel,
            'navigationBar'   => $navigationBarVm,
            'ovalCharms'      => $bag->count(ItemId::OVAL_CHARM),
            'giftPokemon'     => $this->createGiftPokemonViewModels(
                $this->locationConfigRepository->findLocation($currentLocation->id),
                $giftPokemonConfigEntries,
            ),
        ]));
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
}
