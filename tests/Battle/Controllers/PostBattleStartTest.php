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

final class PostBattleStartTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->update("instances", [
            'unused_moves' => 1,
        ], [
            'id' => Instance::DEFAULT_ID,
        ]);

        $response = Website::post("/battle/trainer/00416693-3615-4116-b964-f4960d9387e3");

        $row = $db->fetchAssociative("SELECT * FROM trainer_battles WHERE trainer_id = :trainerId", [
            'trainerId' => "00416693-3615-4116-b964-f4960d9387e3"
        ]);

        assertThat(
            $response->isRedirect(Website::url("/battle/{$row['id']}")),
            isTrue(),
        );
    }
}
