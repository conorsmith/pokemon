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

final class PostPartyItemGive
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
        $itemId = $args['id'];
        $pokemonId = $request->request->get('pokemon');
        $redirectUrlPath = $request->request->get('redirectUrlPath', "/{$instanceId}/party/use/" . $itemId);

        $bag = $this->bagRepository->find();

        $itemConfig = $this->itemConfigRepository->find($itemId);

        if (!$bag->has($itemId)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("No {$itemConfig['name']} remaining.")
            );
            return new RedirectResponse($redirectUrlPath);
        }

        $pokemon = $this->pokemonRepository->find($pokemonId);

        if (is_null($pokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Pokémon not found.")
            );
            return new RedirectResponse($redirectUrlPath);
        }

        $pokemonConfig = $this->pokedexConfigRepository->find($pokemon->number);

        if ($pokemon->isHoldingAnItem()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("{$pokemonConfig['name']} is already holding an item.")
            );
            return new RedirectResponse($redirectUrlPath);
        }

        $bag = $bag->remove($itemId);
        $pokemon = $pokemon->giveItem($itemId);

        $this->bagRepository->save($bag);
        $this->pokemonRepository->save($pokemon);

        $this->notifyPlayerCommand->run(
            Notification::transient("You gave {$itemConfig['name']} to {$pokemonConfig['name']}")
        );
        return new RedirectResponse($redirectUrlPath);
    }
}
