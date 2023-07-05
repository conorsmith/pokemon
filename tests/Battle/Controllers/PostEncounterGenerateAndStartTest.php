<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostEncounterGenerateAndStartTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $response = Website::post("/encounter", [
            'legendary' => PokedexNo::MEWTWO,
        ]);

        $row = $db->fetchAssociative("SELECT * FROM encounters WHERE pokemon_id = :pokemonId", [
            'pokemonId' => PokedexNo::MEWTWO
        ]);

        assertThat(
            $response->isRedirect(Website::url("/encounter/{$row['id']}")),
            isTrue(),
        );
    }
}
