<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Location\Domain\FindWildEncounters;
use ConorSmith\Pokemon\Location\Domain\WildEncounters;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
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
        private readonly FindFeatures $findFeatures,
        private readonly FindWildEncounters $findWildEncounters,
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

        $wildEncounters = $this->findWildEncounters->find($currentLocation->id);

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

    private function createWildEncountersViewModel(WildEncounters $wildEncounters): stdClass
    {
        return (object) [
            'walking'   => $wildEncounters->includesWalking,
            'surfing'   => $wildEncounters->includesSurfing,
            'fishing'   => $wildEncounters->includesFishing,
            'rockSmash' => $wildEncounters->includesRockSmash,
            'headbutt'  => $wildEncounters->includesHeadbutt,
        ];
    }
}
