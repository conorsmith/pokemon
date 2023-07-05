<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\TeamPokemon;
use ConorSmith\Pokemon\SharedKernel\TeamPokemonQuery as TeamPokemonQueryInterface;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepositoryDb;

final class TeamPokemonQuery implements TeamPokemonQueryInterface
{
    public function __construct(
        private readonly PokemonRepositoryDb $pokemonRepository,
    ) {}

    public function run(string $id): TeamPokemon
    {
        $pokemon = $this->pokemonRepository->find($id);

        return new TeamPokemon(
            $pokemon->friendship,
            $pokemon->physicalAttack->baseValue,
            $pokemon->physicalDefence->baseValue,
            $pokemon->specialAttack->baseValue,
            $pokemon->specialDefence->baseValue,
            $pokemon->speed->baseValue,
            $pokemon->hp->baseValue,
            $pokemon->physicalAttack->iv,
            $pokemon->physicalDefence->iv,
            $pokemon->specialAttack->iv,
            $pokemon->specialDefence->iv,
            $pokemon->speed->iv,
            $pokemon->hp->iv,
            $pokemon->physicalAttack->ev,
            $pokemon->physicalDefence->ev,
            $pokemon->specialAttack->ev,
            $pokemon->specialDefence->ev,
            $pokemon->speed->ev,
            $pokemon->hp->ev,
        );
    }
}
