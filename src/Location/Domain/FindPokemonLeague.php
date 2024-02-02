<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\PlayerIsLeagueChampionQuery;

final class FindPokemonLeague
{
    public function __construct(
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly PlayerIsLeagueChampionQuery $playerIsLeagueChampionQuery,
    ) {}

    public function find(string $locationId): ?PokemonLeague
    {
        $eliteFourConfig = $this->eliteFourConfigRepository->findInLocation($locationId);

        if (is_null($eliteFourConfig)) {
            return null;
        }

        return new PokemonLeague(
            $eliteFourConfig['region'],
            $this->playerIsLeagueChampionQuery->run($eliteFourConfig['region']),
        );
    }
}
