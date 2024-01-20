<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Battle;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\AreaIsClearedQuery;

final class BattleRepositoryAreaIsClearedQuery implements AreaIsClearedQuery
{
    public function __construct(
        private readonly BattleRepository $battleRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
    ) {}

    public function run(string $locationId): bool
    {
        $location = $this->locationConfigRepository->findLocation($locationId);

        if (is_null($location)) {
            $locations = $this->locationConfigRepository->findLocationsInArea($locationId);
        } else {
            $locations = [$location];
        }

        foreach ($locations as $location) {
            $battles = $this->battleRepository->findBattlesInLocation($location['id']);
            /** @var ?Battle $battle */
            foreach ($battles as $battle) {
                if (is_null($battle)) {
                    return false;
                }
                if (!$battle->playerHasWon()) {
                    return false;
                }
            }
        }

        return true;
    }
}
