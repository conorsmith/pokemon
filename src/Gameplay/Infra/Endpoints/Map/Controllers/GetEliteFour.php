<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFeatures;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindPokemonLeague;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\PokemonLeague;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetEliteFour
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly LocationRepository $locationRepository,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly FindPokemonLeague $findPokemonLeague,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation);

        if (!$features->hasEliteFour) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $pokemonLeague = $this->findPokemonLeague->find($currentLocation->id);

        if (is_null($pokemonLeague)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Elite Four not found")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        if ($pokemonLeague->isPlayerChampion) {
            $this->notifyPlayerCommand->run(
                Notification::transient("You are already the Champion")
            );
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/EliteFour.php", [
            'currentLocation' => $currentLocationViewModel,
            'challengeTokens' => $bag->count(ItemId::CHALLENGE_TOKEN),
            'eliteFour'       => $this->createEliteFourViewModel($pokemonLeague),
            'navigationBar'   => $navigationBarVm,
        ]));
    }

    private function createEliteFourViewModel(PokemonLeague $pokemonLeague): stdClass
    {
        $config = $this->eliteFourConfigRepository->findInRegion($pokemonLeague->regionId);
        $bag = $this->bagRepository->find();

        $canChallenge = $bag->count(ItemId::CHALLENGE_TOKEN) >= 5
            && $this->hasPlayerEarnedAllRegionalGymBadges($pokemonLeague);

        return (object) [
            'memberImageUrls' => array_map(
                fn (array $memberConfig) => $memberConfig['imageUrl'],
                array_slice($config['members'], 0, 4),
            ),
            'region'          => $pokemonLeague->regionId->value,
            'canChallenge'    => $canChallenge,
        ];
    }

    public function hasPlayerEarnedAllRegionalGymBadges(PokemonLeague $pokemonLeague): bool
    {
        $gymBadges = $this->gymBadgeRepository->findForRegion($pokemonLeague->regionId);

        foreach (GymBadge::allFromRegion($pokemonLeague->regionId) as $gymBadge) {
            if (!in_array($gymBadge, $gymBadges)) {
                return false;
            }
        }

        return true;
    }
}
