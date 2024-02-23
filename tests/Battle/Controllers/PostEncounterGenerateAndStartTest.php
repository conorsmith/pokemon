<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
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

        $db->insert("items", [
            'item_id'     => ItemId::OVAL_CHARM,
            'instance_id' => Instance::DEFAULT_ID,
            'quantity'    => 1,
        ]);

        $response = Website::post("/encounter", [
            'legendary' => PokedexNo::MEWTWO,
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
