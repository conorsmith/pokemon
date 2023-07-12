<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Domain\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\BreedingPokemon;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetPokemonBreed
{
    public function __construct(
        private readonly Session $session,
        private readonly PokemonRepository $pokemonRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (!$pokemon->canBreed()) {
            $vm = BreedingPokemon::create($pokemon);
            $this->session->getFlashBag()->add("errors", "{$vm->name} cannot breed!");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $potentialPartners = $this->pokemonRepository->findAllInEggGroups($pokemon->eggGroups);

        $potentialPartners = array_filter(
            $potentialPartners,
            fn(Pokemon $potentialPartner) => $pokemon->canBreedWith($potentialPartner),
        );

        if (count($potentialPartners) === 0) {
            $vm = BreedingPokemon::create($pokemon);
            $this->session->getFlashBag()->add("errors", "There are no compatible partners for {$vm->name}");
            return new RedirectResponse("/{$instanceId}/bag");
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/BreedingPartners.php", [
            'pokemon' => BreedingPokemon::create($pokemon),
            'partners' => array_map(
                fn(Pokemon $pokemon) => BreedingPokemon::create($pokemon),
                $potentialPartners
            ),
        ]));
    }
}
