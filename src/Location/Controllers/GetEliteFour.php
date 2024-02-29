<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FindPokemonLeague;
use ConorSmith\Pokemon\Location\Domain\PokemonLeague;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\EarnedAllRegionalGymBadgesQuery;
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
        private readonly LocationRepository $locationRepository,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly FindPokemonLeague $findPokemonLeague,
        private readonly EarnedAllRegionalGymBadgesQuery $earnedAllRegionalGymBadgesQuery,
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
            && $this->earnedAllRegionalGymBadgesQuery->run($pokemonLeague->regionId);

        return (object) [
            'memberImageUrls' => array_map(
                fn (array $memberConfig) => $memberConfig['imageUrl'],
                array_slice($config['members'], 0, 4),
            ),
            'region'          => $pokemonLeague->regionId->value,
            'canChallenge'    => $canChallenge,
        ];
    }
}
