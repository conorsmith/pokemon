<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Team\Domain\Pokemon;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\TemplateEngine;
use stdClass;

final class GetPokemon
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
    ) {}

    public function __invoke(array $args): void
    {
        $pokemonId = $args['id'];

        $pokemon = $this->pokemonRepository->find($pokemonId);

        echo TemplateEngine::render(__DIR__ . "/../Templates/Pokemon.php", [
            'pokemon' => PokemonVm::create($pokemon),
            'stats' => self::createStatsVm($pokemon),
        ]);
    }

    private static function createStatsVm(Pokemon $pokemon): stdClass
    {
        return (object) [
            'physicalAttack' => (object) [
                'total' => $pokemon->physicalAttack->calculate($pokemon->level),
                'base'  => $pokemon->physicalAttack->baseValue,
                'iv'    => $pokemon->physicalAttack->iv,
                'ev'    => $pokemon->physicalAttack->ev,
            ],
            'physicalDefence' => (object) [
                'total' => $pokemon->physicalDefence->calculate($pokemon->level),
                'base'  => $pokemon->physicalDefence->baseValue,
                'iv'    => $pokemon->physicalDefence->iv,
                'ev'    => $pokemon->physicalDefence->ev,
            ],
            'specialAttack' => (object) [
                'total' => $pokemon->specialAttack->calculate($pokemon->level),
                'base'  => $pokemon->specialAttack->baseValue,
                'iv'    => $pokemon->specialAttack->iv,
                'ev'    => $pokemon->specialAttack->ev,
            ],
            'specialDefence' => (object) [
                'total' => $pokemon->specialDefence->calculate($pokemon->level),
                'base'  => $pokemon->specialDefence->baseValue,
                'iv'    => $pokemon->specialDefence->iv,
                'ev'    => $pokemon->specialDefence->ev,
            ],
            'speed' => (object) [
                'total' => $pokemon->speed->calculate($pokemon->level),
                'base'  => $pokemon->speed->baseValue,
                'iv'    => $pokemon->speed->iv,
                'ev'    => $pokemon->speed->ev,
            ],
            'hp' => (object) [
                'total' => $pokemon->hp->calculate($pokemon->level),
                'base'  => $pokemon->hp->baseValue,
                'iv'    => $pokemon->hp->iv,
                'ev'    => $pokemon->hp->ev,
            ],
        ];
    }
}
