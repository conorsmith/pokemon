<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;

final class GetTrackPokemon
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(array $args): void
    {
        $encounterType = $args['encounterType'];

        $location = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        echo $this->templateEngine->render(__DIR__ . "/../Templates/TrackPokemon.php", [
            'currentLocation' => $this->viewModelFactory->createLocation($location),
            'pokeballs' => $bag->countAllPokeBalls(),
            'scriptData' => json_encode([
                'encounterType' => $encounterType,
            ]),
        ]);
    }
}
