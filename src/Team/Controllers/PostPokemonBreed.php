<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\ItemId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class PostPokemonBreed
{
    public function __construct(
        private readonly Session $session,
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonAId = $args['id'];
        $pokemonBId = $request->request->get("pokemon");

        $bag = $this->bagRepository->find();

        if (!$bag->has(ItemId::OVAL_CHARM)) {
            $this->session->getFlashBag()->add("errors", "No oval charms remaining");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $pokemonA = $this->pokemonRepository->find($pokemonAId);
        $pokemonB = $this->pokemonRepository->find($pokemonBId);

        if (is_null($pokemonA) || is_null($pokemonB)) {
            $this->session->getFlashBag()->add("errors", "Pokémon not found");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        if (!$pokemonA->canBreedWith($pokemonB)) {
            $this->session->getFlashBag()->add("errors", "Attempt to breed incompatible pokémon");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $bag = $bag->use(ItemId::OVAL_CHARM);

        $this->session->getFlashBag()->add("errors", "Functionality not implemented");
        return new RedirectResponse("/{$instanceId}/bag");
    }
}
