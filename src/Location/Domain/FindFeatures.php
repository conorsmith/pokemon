<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;

final class FindFeatures
{
    public function __construct(
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly FindPokemonLeague $findPokemonLeague,
        private readonly FindTrainers $findTrainers,
    ) {}

    public function find(Location $location): Features
    {
        $wildEncountersConfig = $this->wildEncounterConfigRepository->findWildEncounters($location->id);
        $fixedEncounters = $this->findFixedEncounters->findInLocation($location);
        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($location->id);

        $pokemonLeague = $this->findPokemonLeague->find($location->id);

        $trainers = $this->findTrainers->find($location->id);

        $standardFixedEncounters = array_filter(
            $fixedEncounters,
            fn (FixedEncounter $fixedEncounter) => !$fixedEncounter->isLegendary,
        );

        $legendaryFixedEncounters = array_filter(
            $fixedEncounters,
            fn (FixedEncounter $fixedEncounter) => $fixedEncounter->isLegendary,
        );

        return new Features(
            $wildEncountersConfig->hasTables(),
            count($standardFixedEncounters) > 0,
            count($legendaryFixedEncounters) > 0,
            count($trainers) > 0,
            count($giftPokemonConfigEntries) > 0,
            !is_null($pokemonLeague) && !$pokemonLeague->isPlayerChampion,
        );
    }
}
