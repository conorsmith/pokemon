<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;

final class FindFeatures
{
    public function __construct(
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly FixedEncounterConfigRepository $fixedEncounterConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly FindPokemonLeague $findPokemonLeague,
        private readonly FindTrainers $findTrainers,
    ) {}

    public function find(Location $location): Features
    {
        $wildEncountersConfig = $this->wildEncounterConfigRepository->findWildEncounters($location->id);
        $fixedEncountersConfig = $this->fixedEncounterConfigRepository->findInLocation($location->id);
        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($location->id);

        $legendaryEncounters = $this->findFixedEncounters->findLegendaries($location);

        $pokemonLeague = $this->findPokemonLeague->find($location->id);

        $trainers = $this->findTrainers->find($location->id);

        return new Features(
            $wildEncountersConfig->hasTables(),
            count($fixedEncountersConfig) > 0,
            count($trainers) > 0,
            count($giftPokemonConfigEntries) > 0,
            count($legendaryEncounters) > 0,
            !is_null($pokemonLeague) && !$pokemonLeague->isPlayerChampion,
        );
    }
}
