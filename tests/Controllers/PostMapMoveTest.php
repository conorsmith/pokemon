<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Controllers;

use ConorSmith\Pokemon\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostMapMoveTest extends TestCase
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

        $response = Website::post("/map/move", [
            'location' => LocationId::ROUTE_1,
        ]);

        assertThat(
            $response->isRedirect(Website::url("/map")),
            isTrue(),
        );
    }
}
