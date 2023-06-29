<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Habit\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetLogCalorieGoalTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();

        $response = Website::get("/log/calorie-goal");

        assertThat(
            $response->getContent(),
            stringContains("Calorie Goal</h1>")
        );
    }
}
