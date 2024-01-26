<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use ConorSmith\Pokemon\Party\Domain\Evolution;
use ConorSmith\Pokemon\Party\Domain\Pokemon;

final class EvolutionRepository
{
    public function __construct(
        private readonly PokemonConfigRepository $pokemonConfigRepository,
    ) {}

    public function findAllForPokemon(Pokemon $pokemon): array
    {
        $pokemonConfig = $this->pokemonConfigRepository->find($pokemon->number);

        $evolutions = [];

        if (array_key_exists('evolutions', $pokemonConfig)) {
            foreach ($pokemonConfig['evolutions'] as $number => $evolution) {
                $evolutions[] = new Evolution(
                    strval($number),
                    array_key_exists('level', $evolution) ? $evolution['level'] : null,
                    in_array('friendship', $evolution),
                    array_key_exists('time', $evolution) ? $evolution['time'] : null,
                    array_key_exists('stats', $evolution) ? $evolution['stats'] : null,
                    in_array('randomly', $evolution),
                    array_key_exists('move', $evolution) ? $evolution['move'] : null,
                );
            }
        }

        return $evolutions;
    }
}
