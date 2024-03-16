<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Bag\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
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
        Instance::setup();

        $response = Website::post("/item/" . ItemId::POKE_BALL . "/use");

        assertThat(
            $response->isRedirect(Website::url("/party/use/" . ItemId::POKE_BALL)),
            isTrue(),
        );
    }
}
