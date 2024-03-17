<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFeatures;
use ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Map\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Item;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetFacilities
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly LocationRepository $locationRepository,
        private readonly FindFeatures $findFeatures,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $currentLocation = $this->locationRepository->findCurrentLocation();
        $bag = $this->bagRepository->find();

        $features = $this->findFeatures->find($currentLocation);

        if (!$features->hasFacilities) {
            return new RedirectResponse("/{$args['instanceId']}/map");
        }

        if ($currentLocation->id === LocationId::CINNABAR_LAB
            || $currentLocation->id === LocationId::DEVON_CORPORATION
        ) {
            $fossils = $bag->getEachOfType(ItemType::FOSSIL);
        } else {
            $fossils = null;
        }

        $currentLocationViewModel = $this->viewModelFactory->createLocation($currentLocation);
        $navigationBarVm = $this->viewModelFactory->createNavigationBar($features);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Facilities.php", [
            'currentLocation'  => $currentLocationViewModel,
            'navigationBar'    => $navigationBarVm,
            'canReviveFossils' => !is_null($fossils),
            'fossils'          => $this->createFossilVms($fossils),
        ]));
    }

    private function createFossilVms(array $fossils): array
    {
        $vms = [];

        /** @var Item $fossil */
        foreach ($fossils as $fossil) {
            $itemConfig = $this->itemConfigRepository->find($fossil->id);
            $vms[] = (object) [
                'itemId' => $fossil->id,
                'name' => $itemConfig['name'],
                'imageUrl' => $itemConfig['imageUrl'],
                'quantity' => $fossil->quantity,
            ];
        }

        return $vms;
    }
}
