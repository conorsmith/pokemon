<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Habit\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\countOf;
use function PHPUnit\Framework\isTrue;

final class PostLogExerciseTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $response = Website::post("/log/exercise", [
            'date'         => "2023-01-01",
            'earlier_date' => "",
            'type'         => "short-walk",
        ]);

        assertThat(
            $response->isRedirect(Website::url("/")),
            isTrue(),
        );

        $db = Database::createDatabaseConnection();

        $rows = $db->fetchAllAssociative("SELECT * FROM log_exercise WHERE instance_id = :instanceId", [
            'instanceId' => Instance::DEFAULT_ID,
        ]);

        assertThat(
            $rows,
            countOf(1)
        );
    }
}
