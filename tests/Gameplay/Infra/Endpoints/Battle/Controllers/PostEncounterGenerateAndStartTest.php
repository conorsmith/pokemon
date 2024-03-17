<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Battle\Controllers;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
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

        $db->insert("items", [
            'item_id'     => ItemId::OVAL_CHARM,
            'instance_id' => Instance::DEFAULT_ID,
            'quantity'    => 1,
        ]);

        $db->insert("items", [
            'item_id'     => ItemId::ULTRA_BALL,
            'instance_id' => Instance::DEFAULT_ID,
            'quantity'    => 1,
        ]);

        $db->update("instances", [
            'current_location' => LocationId::CERULEAN_CAVE_B1F,
            'badges'           => json_encode([1, 2, 3, 4, 5, 6, 7, 8]),
        ], [
            'id' => Instance::DEFAULT_ID,
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

        for ($i = 0; $i < 125; $i++) {
            $db->insert("pokedex_entries", [
                'id' => Uuid::uuid4()->toString(),
                'instance_id' => Instance::DEFAULT_ID,
                'number' => strval($i + 1),
                'date_added' => CarbonImmutable::now("Europe/Dublin")->format("Y-m-d H:i:s")
            ]);
        }

        $response = Website::post("/encounter", [
            'pokedexNumber' => PokedexNo::MEWTWO,
        ]);

        $row = $db->fetchAssociative("
            SELECT *
            FROM encounters
            WHERE instance_id = :instanceId
                AND pokemon_id = :pokemonId
        ", [
            'instanceId' => Instance::DEFAULT_ID,
            'pokemonId'  => PokedexNo::MEWTWO
        ]);

        assertThat(
            $response->isRedirect(Website::url("/encounter/{$row['id']}")),
            isTrue(),
        );
    }
}
