<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetPartyItemUseTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("items", [
            'item_id'     => ItemId::POKE_BALL,
            'instance_id' => Instance::DEFAULT_ID,
            'quantity'    => 1,
        ]);

        $response = Website::get("/party/use/" . ItemId::POKE_BALL);

        assertThat(
            $response->getContent(),
            stringContains("Choose Pokémon on which to use")
        );
    }
}
