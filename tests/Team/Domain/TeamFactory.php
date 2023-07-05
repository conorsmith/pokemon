<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Domain;

use ConorSmith\Pokemon\Team\Domain\Team;

final class TeamFactory
{
    public static function any(): Team
    {
        return new Team([]);
    }

    public static function notFull(): Team
    {
        return new Team([]);
    }

    public static function full(): Team
    {
        return new Team([
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
        ]);
    }
}
