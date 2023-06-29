<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Controllers;

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetTrackPokemonTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->update("instances", [
            'current_location' => LocationId::PALLET_TOWN,
        ], [
            'id' => Instance::DEFAULT_ID,
        ]);

        $response = Website::get("/track-pokemon/" . EncounterType::WALKING);

        assertThat(
            $response->getContent(),
            stringContains("Pallet Town")
        );
    }
}
