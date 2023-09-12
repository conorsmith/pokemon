<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyBox
{
    public function __invoke(Request $request, array $args): Response
    {
        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}
