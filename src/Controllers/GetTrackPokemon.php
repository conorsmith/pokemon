<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetTrackPokemon
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $encounterType = $args['encounterType'];

        $location = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/TrackPokemon.php", [
            'currentLocation' => $this->viewModelFactory->createLocation($location),
            'pokeballs' => $bag->countAllPokeBalls(),
            'encounterTypeClasses' => match ($encounterType) {
                EncounterType::WALKING    => "fas fa-shoe-prints",
                EncounterType::SURFING    => "fas fa-water",
                EncounterType::FISHING    => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
            },
            'scriptData' => json_encode([
                'instanceId' => $args['instanceId'],
                'encounterType' => $encounterType,
            ]),
        ]));
    }
}
