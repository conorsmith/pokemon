<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class PostBattleFightTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("trainer_battles", [
            'id'                   => "the-battle-id",
            'instance_id'          => Instance::DEFAULT_ID,
            'trainer_id'           => "00416693-3615-4116-b964-f4960d9387e3",
            'is_battling'          => 1,
            'is_player_challenger' => 1,
            'battle_count'         => 0,
            'active_pokemon'       => 1,
        ]);

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
            'location'            => "team",
            'has_fainted'         => 0,
            'location_caught'     => LocationId::PALLET_TOWN,
            'date_caught'         => "2023-01-01 00:00:00",
        ]);

        $response = Website::post("/battle/the-battle-id/fight", [
            'attack' => "physical-primary",
        ]);

        assertThat(
            $response->getContent(),
            stringContains("Your Bulbasaur")
        );
    }
}
