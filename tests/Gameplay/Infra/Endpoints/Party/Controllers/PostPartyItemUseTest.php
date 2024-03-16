<?php

declare(strict_types=1);

namespace ConorSmith\PokemonTest\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\PokemonTest\Support\Database;
use ConorSmith\PokemonTest\Support\Instance;
use ConorSmith\PokemonTest\Support\Website;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertThat;
use function PHPUnit\Framework\isTrue;

final class PostPartyItemUseTest extends TestCase
{
    #[Test]
    function processes_request()
    {
        Database::setup();
        Instance::setup();

        $response = Website::post("/party/use/" . ItemId::RARE_CANDY, [
            'pokemon' => "dontcare",
        ]);

        assertThat(
            $response->isRedirect(Website::url("/party/use/" . ItemId::RARE_CANDY)),
            isTrue(),
        );
    }
}
