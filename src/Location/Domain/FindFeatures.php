<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Domain;

use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;

final class FindFeatures
{
    public function __construct(
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly FindFixedEncounters $findFixedEncounters,
        private readonly FindPokemonLeague $findPokemonLeague,
        private readonly FindTrainers $findTrainers,
    ) {}

    public function find(string $locationId): Features
    {
        $wildEncounters = $this->wildEncounterConfigRepository->findWildEncounters($locationId);
        $giftPokemonConfigEntries = $this->giftPokemonConfigRepository->findInLocation($locationId);

        $legendaryEncounter = $this->findFixedEncounters->findLegendary(
            $this->locationConfigRepository->findLocation($locationId)
        );

        $pokemonLeague = $this->findPokemonLeague->find($locationId);

        $trainers = $this->findTrainers->find($locationId);

        return new Features(
            !is_null($wildEncounters),
            count($trainers) > 0,
            count($giftPokemonConfigEntries) > 0,
            !is_null($legendaryEncounter),
            !is_null($pokemonLeague) && !$pokemonLeague->isPlayerChampion,
        );
    }
}
