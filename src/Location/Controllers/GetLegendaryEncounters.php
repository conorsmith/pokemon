<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FindFixedEncounters;
use ConorSmith\Pokemon\Location\Domain\FixedEncounter;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetLegendaryEncounters
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly FindFeatures $findFeatures,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation->id);

        if (!$features->hasLegendaryEncounters) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $legendaryEncounter = $this->findFixedEncounters->findLegendary(
            $this->locationConfigRepository->findLocation($currentLocation->id)
        );

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/LegendaryEncounters.php", [
            'currentLocation' => $currentLocationViewModel,
            'navigationBar'   => $navigationBarVm,
            'ovalCharms'      => $bag->count(ItemId::OVAL_CHARM),
            'legendary'       => $legendaryEncounter
                ? $this->createLegendaryViewModel($legendaryEncounter)
                : null,
        ]));
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
}
