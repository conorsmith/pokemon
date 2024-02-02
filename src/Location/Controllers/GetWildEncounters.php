<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetWildEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation->id);

        if (!$features->hasWildEncounters) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $wildEncounters = $this->wildEncounterConfigRepository->findWildEncounters($currentLocation->id);

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/WildEncounters.php", [
            'currentLocation' => $currentLocationViewModel,
            'canEncounter'    => true,
            'pokeballs'       => $bag->countAllPokeBalls(),
            'wildEncounters'  => $this->createWildEncountersViewModel($wildEncounters),
            'navigationBar'   => $navigationBarVm,
        ]));
    }

    private function createWildEncountersViewModel(array $wildEncounterTables): stdClass
    {
        return (object) [
            'walking'   => isset($wildEncounterTables[EncounterType::WALKING]),
            'surfing'   => isset($wildEncounterTables[EncounterType::SURFING]),
            'fishing'   => isset($wildEncounterTables[EncounterType::FISHING]),
            'rockSmash' => isset($wildEncounterTables[EncounterType::ROCK_SMASH]),
            'headbutt'  => isset($wildEncounterTables[EncounterType::HEADBUTT]),
        ];
    }
}
