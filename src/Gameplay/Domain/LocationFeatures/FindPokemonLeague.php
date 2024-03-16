<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;

final class FindPokemonLeague
{
    public function __construct(
        private readonly LeagueChampionRepository $leagueChampionRepository,
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
    ) {}

    public function find(string $locationId): ?PokemonLeague
    {
        $eliteFourConfig = $this->eliteFourConfigRepository->findInLocation($locationId);

        if (is_null($eliteFourConfig)) {
            return null;
        }

        $leagueChampion = $this->leagueChampionRepository->find($eliteFourConfig['region']);

        return new PokemonLeague(
            $eliteFourConfig['region'],
            $leagueChampion->isPlayer(),
        );
    }
}
