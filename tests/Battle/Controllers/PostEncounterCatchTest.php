<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class PostEncounterCatchTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("items", [
            'item_id'     => ItemId::POKE_BALL,
            'instance_id' => Instance::DEFAULT_ID,
            'quantity'    => 1,
        ]);

        $db->insert("encounters", [
            'id'                          => "the-encounter-id",
            'instance_id'                 => Instance::DEFAULT_ID,
            'pokemon_id'                  => 1,
            'level'                       => 0,
            'sex'                         => "U",
            'is_shiny'                    => 0,
            'is_legendary'                => 0,
            'iv_physical_attack'          => 0,
            'iv_physical_defence'         => 0,
            'iv_special_attack'           => 0,
            'iv_special_defence'          => 0,
            'iv_speed'                    => 0,
            'iv_hp'                       => 0,
            'remaining_hp'                => 0,
            'has_started'                 => 0,
            'was_caught'                  => 0,
            'strength_indicator_progress' => 0,
            'generated_at'                => "2023-01-01 00:00:00",
        ]);

        $db->update("instances", [
            'current_location' => LocationId::PALLET_TOWN,
        ], [
            'id' => Instance::DEFAULT_ID,
        ]);

        $response = Website::post("/encounter/the-encounter-id/catch", [
            'pokeball' => ItemId::POKE_BALL,
        ]);

        assertThat(
            $response->getContent(),
            stringContains("the wild Bulbasaur")
        );
    }
}
