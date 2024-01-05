<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class PostPartyMoveDown
{
    public function __construct(
        private readonly Connection $db,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly NotifyPlayerCommand $notifyPlayerCommand,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokemonId = $request->request->get('pokemon');

        $rows = $this->caughtPokemonRepository->getParty();

        foreach ($rows as $i => $pokemonRow) {
            if ($pokemonRow['id'] === $pokemonId) {
                if ($pokemonRow['party_position'] === count($rows)) {
                    $this->notifyPlayerCommand->run(
                        Notification::transient("Target Pokémon cannot be moved down")
                    );
                    return new RedirectResponse("/{$args['instanceId']}/party");
                }
                $targetPokemon = $rows[$i];
                $affectedPokemon = $rows[$i + 1];
            }
        }

        if (!isset($targetPokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Target Pokémon not found")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        if (!isset($affectedPokemon)) {
            $this->notifyPlayerCommand->run(
                Notification::transient("Affected Pokémon not found")
            );
            return new RedirectResponse("/{$args['instanceId']}/party");
        }

        $this->db->beginTransaction();

        $this->db->update("caught_pokemon", [
            'party_position' => $targetPokemon['party_position'] + 1,
        ], [
            'id' => $targetPokemon['id'],
        ]);

        $this->db->update("caught_pokemon", [
            'party_position' => $affectedPokemon['party_position'] - 1,
        ], [
            'id' => $affectedPokemon['id'],
        ]);

        $this->db->commit();

        return new RedirectResponse("/{$args['instanceId']}/party");
    }
}