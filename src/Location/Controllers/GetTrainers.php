<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FindTrainers;
use ConorSmith\Pokemon\Location\Domain\Trainer;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetTrainers
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly FindFeatures $findFeatures,
        private readonly FindTrainers $findTrainers,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation);

        if (!$features->hasTrainers) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Trainers.php", [
            'currentLocation' => $currentLocationViewModel,
            'challengeTokens' => $bag->count(ItemId::CHALLENGE_TOKEN),
            'trainers'        => $this->createTrainerViewModels(
                $this->findTrainers->find($currentLocation->id)
            ),
            'navigationBar'   => $navigationBarVm,
        ]));
    }

    private function createTrainerViewModels(array $trainers): array
    {
        $vms = [];

        /** @var Trainer $trainer */
        foreach ($trainers as $trainer) {
            $config = $this->trainerConfigRepository->findTrainer($trainer->id);

            if (array_key_exists('imageUrl', $config)) {
                $imageUrl = $config['imageUrl'];
            } else {
                $imageUrl = TrainerClass::getImageUrl($config['class'], $config['gender'] ?? Gender::IMMATERIAL);
            }

            if (array_key_exists('leader', $config)) {
                $imageUrl = $config['leader']['imageUrl'];
            }

            $lastBeatenFormatted = $trainer->lastBeaten
                ? (new CarbonImmutable($trainer->lastBeaten))->ago()
                : "";

            $vms[] = (object) [
                'id'          => $trainer->id,
                'name'        => TrainerClass::getLabel($config['class']) . (isset($config['name']) ? " {$config['name']}" : ""),
                'imageUrl'    => $imageUrl,
                'party'       => $trainer->partySize,
                'canBattle'   => $trainer->playerCanBattle,
                'lastBeaten'  => $lastBeatenFormatted,
                'isGymLeader' => $trainer->isGymLeader,
                'leaderBadge' => $trainer->isGymLeader
                    ? $this->sharedViewModelFactory->createGymBadgeName($config['leader']['badge'])
                    : "",
            ];
        }

        return $vms;
    }
}
