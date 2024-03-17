<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use RuntimeException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetTrackPokemon
{
    public function __construct(
        private readonly LocationRepository $locationRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly BagRepository $bagRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $encounterType = $args['encounterType'];

        $party = $this->pokemonRepository->getParty();

        if ($party->isEmpty()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Your party is empty."),
            );
            return new RedirectResponse("/{$instanceId}/map/pokemon");
        }

        $location = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/TrackPokemon.php", [
            'currentLocation'      => $this->viewModelFactory->createLocationName($location),
            'pokeballs'            => $bag->countAllPokeBalls(),
            'encounterTypeClasses' => match ($encounterType) {
                EncounterType::WALKING    => "fas fa-shoe-prints",
                EncounterType::SURFING    => "fas fa-water",
                EncounterType::FISHING    => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
                EncounterType::HEADBUTT   => "fas fa-tree",
                default                   => throw new RuntimeException(),
            },
            'scriptData'           => json_encode([
                'instanceId'    => $args['instanceId'],
                'encounterType' => $encounterType,
            ]),
        ]));
    }
}
