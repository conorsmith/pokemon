<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostItemUseTest extends TestCase
{
    #[Test]
    function loads_page()
    {
        Database::setup();

        $response = Website::post("/item/" . ItemId::POKE_BALL . "/use");

        assertThat(
            $response->isRedirect(Website::url("/team/use/" . ItemId::POKE_BALL)),
            isTrue(),
        );
    }
}
