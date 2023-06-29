<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Team\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostTeamMoveUpTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();

        $response = Website::post("/team/move-up", [
            'pokemon' => "dontcare",
        ]);

        assertThat(
            $response->isRedirect(Website::url("/team")),
            isTrue(),
        );
    }
}
