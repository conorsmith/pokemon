<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Controllers;

use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use Symfony\Component\HttpFoundation\Session\Session;

final class GetIndex
{
    public function __construct(
        private readonly Session $session,
        private readonly CaughtPokemonRepository $caughtPokemonRepository,
        private readonly array $pokedex,
    ) {}

    public function __invoke(): void
    {
        $rows = $this->caughtPokemonRepository->getTeam();

        $team = TeamMember::fromRows($rows, $this->pokedex);

        $successes = $this->session->getFlashBag()->get("successes");

        $encounterData = $this->session->getFlashBag()->get('encounter');

        if ($encounterData) {

            $encounteredPokemon = $this->pokedex[$encounterData['pokemon']['id']];

            $encounter = (object)[
                'pokemon'   => (object)[
                    'name'     => $encounteredPokemon['name'],
                    'imageUrl' => TeamMember::createImageUrl($encounterData['pokemon']['id']),
                    'level'    => $encounterData['pokemon']['level'],
                ],
                'caught'    => $encounterData['caught'],
                'sentToBox' => $encounterData['sentToBox'],
            ];
        }

        echo TemplateEngine::render(__DIR__ . "/../Templates/Index.php", [
            'team' => $team,
            'successes' => $successes,
            'encounter' => $encounter ?? null,
        ]);
    }
}
