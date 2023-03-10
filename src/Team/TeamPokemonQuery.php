<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\SharedKernel\TeamPokemon;
use ConorSmith\Pokemon\SharedKernel\TeamPokemonQuery as TeamPokemonQueryInterface;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;

final class TeamPokemonQuery implements TeamPokemonQueryInterface
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function run(string $id): TeamPokemon
    {
        $pokemon = $this->pokemonRepository->find($id);

        return new TeamPokemon(
            $pokemon->friendship,
            $pokemon->physicalAttack->calculate($pokemon->level),
            $pokemon->physicalDefence->calculate($pokemon->level),
            $pokemon->specialAttack->calculate($pokemon->level),
            $pokemon->specialDefence->calculate($pokemon->level),
            $pokemon->speed->calculate($pokemon->level),
            $pokemon->hp->calculate($pokemon->level),
        );
    }
}
