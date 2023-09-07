<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class PostEncounterGenerateTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->update("instances", [
            'current_location' => LocationId::ROUTE_1,
        ], [
            'id' => Instance::DEFAULT_ID,
        ]);

        $response = Website::post("/encounter/generate", [
            'encounterType' => EncounterType::WALKING,
        ]);

        assertThat(
            $response->getContent(),
            stringContains("isRegistered")
        );
    }
}
