<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\Domain\Pokemon;
use ConorSmith\Pokemon\Party\Domain\PokemonRepository;
use ConorSmith\Pokemon\Party\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyItemUse
{
    public function __construct(
        private readonly BagRepository $bagRepository,
        private readonly PokemonRepository $pokemonRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $itemId = $args['id'];

        $bag = $this->bagRepository->find();
        $party = $this->pokemonRepository->getParty();

        $itemConfig = require __DIR__ . "/../../Config/Items.php";

        if ($bag->count($itemId) < 1) {
            $this->notifyPlayerCommand->run(
                Notification::persistent("You have no more {$itemConfig[$itemId]['name']}")
            );
            return new RedirectResponse("/{$args['instanceId']}/bag");
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PartyUse.php", [
            'item'    => (object) [
                'id'       => $itemId,
                'name'     => $itemConfig[$itemId]['name'],
                'imageUrl' => $itemConfig[$itemId]['imageUrl'],
            ],
            'party'   => array_map(
                fn(Pokemon $pokemon) => PokemonVm::create($pokemon),
                $party->members
            ),
        ]));
    }
}
