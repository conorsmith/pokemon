<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetHallOfFameTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("elite_four_challenges", [
            'id'             => "dontcare",
            'region'         => "KANTO",
            'party'          => json_encode([
                [
                    'id'            => "dontcare",
                    'pokedexNumber' => "1",
                    'form'          => null,
                    'level'         => 0,
                ],
            ]),
            'stage'          => 0,
            'victory'        => 1,
            'date_started'   => "2023-01-01 00:00:00",
            'date_completed' => "2023-01-01 00:00:00",
        ]);

        $response = Website::get("/hall-of-fame/kanto");

        assertThat(
            $response->getContent(),
            stringContains("Bulbasaur")
        );
    }
}
