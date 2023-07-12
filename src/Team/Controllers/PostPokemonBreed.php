<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPokemonBreed
{
    public function __construct(
        private readonly Session $session,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];

        $this->session->getFlashBag()->add("errors", "Functionality not implemented");
        return new RedirectResponse("/{$instanceId}/bag");
    }
}
