<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Battle\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostBattleFinishTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();

        $db = Database::createDatabaseConnection();

        $db->insert("trainer_battles", [
            'id'             => "the-battle-id",
            'instance_id'    => Instance::DEFAULT_ID,
            'trainer_id'     => "00416693-3615-4116-b964-f4960d9387e3",
            'is_battling'    => 1,
            'battle_count'   => 0,
            'active_pokemon' => 1,
        ]);

        $response = Website::post("/battle/the-battle-id/finish");

        assertThat(
            $response->isRedirect(Website::url("/map")),
            isTrue(),
        );
    }
}
