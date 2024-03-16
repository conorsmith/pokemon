<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Player\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\RegionalStatus;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use LogicException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetStatus
{
    public function __construct(
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly GymBadgeRepository $gymBadgeRepository,
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly ViewModelFactory $viewModelFactory,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $regions = [
            RegionId::KANTO,
            RegionId::JOHTO,
            RegionId::HOENN,
        ];

        $regionalStatuses = [];
        $previousRegionId = null;

        /** @var RegionId $regionId */
        foreach ($regions as $regionId) {

            $eliteFourChallenge = $this->eliteFourChallengeRepository->findPlayerVictoryInRegion($regionId);
            $leagueChampion = $this->leagueChampionRepository->find($regionId);

            $regionalStatuses[] = new RegionalStatus(
                $regionId,
                is_null($previousRegionId)
                    ? true
                    : !is_null($eliteFourChallenge),
                $this->gymBadgeRepository->findForRegion($regionId),
                $leagueChampion->isPlayer(),
            );

            $previousRegionId = $regionId;
        }

        $regionalStatuses = array_reverse($regionalStatuses);

        $regionalStatusViewModels = [];

        /** @var RegionalStatus $regionalStatus */
        foreach ($regionalStatuses as $regionalStatus) {
            if (!$regionalStatus->hasAccess) {
                continue;
            }

            $badgeVms = [];

            $allRegionalBadges = GymBadge::allFromRegion($regionalStatus->regionId);

            foreach ($allRegionalBadges as $badge) {
                if (in_array($badge, $regionalStatus->badges)) {
                    $badgeVms[] = $this->viewModelFactory->createGymBadge($badge);
                } else {
                    $badgeVms[] = false;
                }
            }

            $regionalStatusViewModels[] = (object) [
                'region' => strtolower($regionalStatus->regionId->value),
                'name'   => match ($regionalStatus->regionId) {
                    RegionId::KANTO => "Kanto",
                    RegionId::JOHTO => "Johto",
                    RegionId::HOENN => "Hoenn",
                    default         => throw new LogicException(),
                },
                'badges' => $badgeVms,
                'isChampion' => $regionalStatus->isChampion,
            ];
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Status.php", [
            'regionalStatuses' => $regionalStatusViewModels,
        ]));
    }
}
