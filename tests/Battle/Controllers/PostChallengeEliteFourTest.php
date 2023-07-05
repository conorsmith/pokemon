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

final class PostChallengeEliteFourTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $db = Database::createDatabaseConnection();

        $db->update("instances", [
            'unused_moves' => 5,
        ], [
            'id' => Instance::DEFAULT_ID,
        ]);

        $response = Website::post("/challenge/elite-four/KANTO");

        $row = $db->fetchAssociative("SELECT * FROM trainer_battles WHERE trainer_id = :trainerId", [
            'trainerId' => "e06b0584-3f6d-47ce-a100-fab5b75e62b5"
        ]);

        assertThat(
            $response->isRedirect(Website::url("/battle/{$row['id']}")),
            isTrue(),
        );
    }
}
