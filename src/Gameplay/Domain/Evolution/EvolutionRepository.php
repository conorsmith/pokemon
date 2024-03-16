<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Evolution;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;

interface EvolutionRepository
{
    public function findAllForPokemon(Pokemon $pokemon): array;
}
