<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\BreedingPokemon;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokemonBreed
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly TemplateEngine $templateEngine,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (!$pokemon->canBreed()) {
            $vm = BreedingPokemon::create($pokemon);
            $this->notifyPlayerCommand->run(
                Notification::transient("{$vm->name} cannot breed!")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        $potentialPartners = $this->pokemonRepository->findAllInEggGroups($pokemon->eggGroups);

        $potentialPartners = array_filter(
            $potentialPartners,
            fn(Pokemon $potentialPartner) => $pokemon->canBreedWith($potentialPartner),
        );

        if (count($potentialPartners) === 0) {
            $vm = BreedingPokemon::create($pokemon);
            $this->notifyPlayerCommand->run(
                Notification::transient("There are no compatible partners for {$vm->name}")
            );
            return new RedirectResponse("/{$instanceId}/bag");
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/BreedingPartners.php", [
            'pokemon'  => BreedingPokemon::create($pokemon),
            'partners' => array_map(
                fn(Pokemon $pokemon) => BreedingPokemon::create($pokemon),
                $potentialPartners
            ),
        ]));
    }
}
