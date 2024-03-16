<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Party;

interface CaughtPokemonRepository
{
    public function getParty(): array;
}
