<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetPokemonTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("caught_pokemon", [
            'id'                  => "the-pokemon-id",
            'instance_id'         => Instance::DEFAULT_ID,
            'pokemon_id'          => 1,
            'sex'                 => "U",
            'is_shiny'            => 0,
            'iv_physical_attack'  => 0,
            'iv_physical_defence' => 0,
            'iv_special_attack'   => 0,
            'iv_special_defence'  => 0,
            'iv_speed'            => 0,
            'iv_hp'               => 0,
            'ev_physical_attack'  => 0,
            'ev_physical_defence' => 0,
            'ev_special_attack'   => 0,
            'ev_special_defence'  => 0,
            'ev_speed'            => 0,
            'ev_hp'               => 0,
            'level'               => 0,
            'location'            => "dontcare",
            'has_fainted'         => 0,
            'location_caught'     => LocationId::PALLET_TOWN,
            'date_caught'         => "2023-01-01 00:00:00",
        ]);

        $response = Website::get("/party/member/the-pokemon-id");

        assertThat(
            $response->getContent(),
            stringContains("Bulbasaur")
        );
    }
}
