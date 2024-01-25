<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPokemonItemTake
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepositoryDb $pokemonRepository,
        private readonly ItemConfigRepository $itemConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $instanceId = $args['instanceId'];
        $pokemonId = $args['id'];
        $redirectUrlPath = "/{$instanceId}/party/member/{$pokemonId}";

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse($redirectUrlPath);
        }

        $pokemonConfig = $this->pokedexConfigRepository->find($pokemon->number);

        if (!$pokemon->isHoldingAnItem()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("{$pokemonConfig['name']} is not holding an item.")
            );
            return new RedirectResponse($redirectUrlPath);
        }

        $bag = $this->bagRepository->find();

        $itemId = $pokemon->heldItemId;

        $pokemon = $pokemon->takeItem();
        $bag = $bag->add($itemId);

        $this->pokemonRepository->save($pokemon);
        $this->bagRepository->save($bag);

        $itemConfig = $this->itemConfigRepository->find($itemId);

        $this->notifyPlayerCommand->run(
            Notification::transient("You took {$itemConfig['name']} from {$pokemonConfig['name']}")
        );
        return new RedirectResponse($redirectUrlPath);
    }
}
