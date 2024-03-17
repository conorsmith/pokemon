<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\Controllers;

use ConorSmith\Pokemon\Gameplay\App\UseCases\CreateAFixedEncounter;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartAnEncounter;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostEncounterGenerateAndStart
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly CreateAFixedEncounter $createAFixedEncounter,
        private readonly StartAnEncounter $startAnEncounter,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokedexNumber = $request->request->get('pokedexNumber');

        $party = $this->pokemonRepository->getParty();

        if ($party->isEmpty()) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Your party is empty.")
            );
            return new RedirectResponse("/{$args['instanceId']}/map/pokemon");
        }

        $result = $this->createAFixedEncounter->__invoke($pokedexNumber);

        $this->startAnEncounter->__invoke($result->encounter->id);

        return new RedirectResponse("/{$args['instanceId']}/encounter/{$result->encounter->id}");
    }
}
