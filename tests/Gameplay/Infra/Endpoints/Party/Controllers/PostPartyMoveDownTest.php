<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostPartyMoveDownTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $response = Website::post("/party/move-down", [
            'pokemon' => "dontcare",
        ]);

        assertThat(
            $response->isRedirect(Website::url("/party")),
            isTrue(),
        );
    }
}
