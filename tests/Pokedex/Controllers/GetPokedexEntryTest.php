<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Pokedex\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetPokedexEntryTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("pokedex_entries", [
            'id'          => "dontcare",
            'instance_id' => Instance::DEFAULT_ID,
            'number'      => 1,
            'form'        => null,
            'date_added'  => "2023-01-01 00:00:00",
        ]);

        $response = Website::get("/pokedex/1");

        assertThat(
            $response->getContent(),
            stringContains("Pokédex</h")
        );
    }
}
