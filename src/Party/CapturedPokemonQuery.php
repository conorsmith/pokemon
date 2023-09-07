<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQuery as QueryInterface;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryParameters;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryProperty;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryResult;
use ConorSmith\Pokemon\SharedKernel\Queries\CapturedPokemonQueryResultStats;
use WeakMap;

final class CapturedPokemonQuery implements QueryInterface
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(CapturedPokemonQueryParameters $parameters): array
    {
        $party = $this->pokemonRepository->getParty();

        $results = [];

        /** @var Pokemon $partyMember */
        foreach ($party->members as $partyMember) {
            $resultPokemon = new WeakMap();

            /** @var CapturedPokemonQueryProperty $property */
            foreach ($parameters->properties as $property) {
                $resultPokemon[$property] = match ($property) {
                    CapturedPokemonQueryProperty::FORM       => $partyMember->form,
                    CapturedPokemonQueryProperty::SEX        => $partyMember->sex,
                    CapturedPokemonQueryProperty::LEVEL      => $partyMember->level,
                    CapturedPokemonQueryProperty::IS_SHINY   => $partyMember->isShiny,
                    CapturedPokemonQueryProperty::FRIENDSHIP => $partyMember->friendship,
                    CapturedPokemonQueryProperty::BASE_STATS => new CapturedPokemonQueryResultStats(
                        $partyMember->hp->baseValue,
                        $partyMember->physicalAttack->baseValue,
                        $partyMember->physicalDefence->baseValue,
                        $partyMember->specialAttack->baseValue,
                        $partyMember->specialDefence->baseValue,
                        $partyMember->speed->baseValue,
                    ),
                    CapturedPokemonQueryProperty::IV_STATS   => new CapturedPokemonQueryResultStats(
                        $partyMember->hp->iv,
                        $partyMember->physicalAttack->iv,
                        $partyMember->physicalDefence->iv,
                        $partyMember->specialAttack->iv,
                        $partyMember->specialDefence->iv,
                        $partyMember->speed->iv,
                    ),
                    CapturedPokemonQueryProperty::EV_STATS   => new CapturedPokemonQueryResultStats(
                        $partyMember->hp->ev,
                        $partyMember->physicalAttack->ev,
                        $partyMember->physicalDefence->ev,
                        $partyMember->specialAttack->ev,
                        $partyMember->specialDefence->ev,
                        $partyMember->speed->ev,
                    ),
                };
            }

            $results[] = new CapturedPokemonQueryResult(
                $partyMember->id,
                $partyMember->number,
                $resultPokemon,
            );
        }

        return $results;
    }
}
