<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Pokedex\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetPokedexTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();

        $response = Website::get("/pokedex");

        assertThat(
            $response->getContent(),
            stringContains("Pokédex</h")
        );
    }
}
