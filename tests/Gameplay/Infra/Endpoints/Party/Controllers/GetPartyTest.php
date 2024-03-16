<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\stringContains;

final class GetPartyTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();
        Instance::setup();

        $response = Website::get("/party");

        assertThat(
            $response->getContent(),
            stringContains("<strong>Party</strong>")
        );
    }
}
