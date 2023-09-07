<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Party\Domain;

use ConorSmith\Pokemon\Party\Domain\Party;

final class PartyFactory
{
    public static function any(): Party
    {
        return new Party([]);
    }

    public static function notFull(): Party
    {
        return new Party([]);
    }

    public static function full(): Party
    {
        return new Party([
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
            PokemonFactory::any(),
        ]);
    }
}
