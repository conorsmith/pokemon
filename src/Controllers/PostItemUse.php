<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostItemUse
{
    public function __invoke(Request $request, array $args): Response
    {
        $itemId = $args['id'];

        return new RedirectResponse("/{$args['instanceId']}/team/use/{$itemId}");
    }
}
