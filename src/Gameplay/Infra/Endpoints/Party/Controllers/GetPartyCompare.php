<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\Party\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyCompare
{
    public function __construct(
        private readonly PokemonRepository $pokemonRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $query = (object) [
            'show'   => $request->query->get('show') ?? "effective-stats",
            'sort'   => $request->query->get('sort') ?? "number",
            'filter' => $request->query->all('filter'),
        ];

        $allPokemon = $this->pokemonRepository->getAll($query);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PartyCompare.php", [
            'buildQuery'  => function (string $key, string $value) use ($query) {
                $query = (array) $query;
                $query[$key] = $value;
                return http_build_query($query);
            },
            'clearFilter' => function (string $key) use ($query) {
                $query = (array) $query;
                unset($query['filter'][$key]);
                return http_build_query($query);
            },
            'query'       => $query,
            'allPokemon'  => array_map(
                fn(Pokemon $pokemon) => self::createPokemonVm($pokemon),
                $allPokemon
            ),
            'typeFilters' => array_map(fn(int $type) => self::createTypeFilterVm($type, $query), [
                PokemonType::NORMAL,
                PokemonType::FIGHTING,
                PokemonType::FLYING,
                PokemonType::POISON,
                PokemonType::GROUND,
                PokemonType::ROCK,
                PokemonType::BUG,
                PokemonType::GHOST,
                PokemonType::STEEL,
                PokemonType::FIRE,
                PokemonType::WATER,
                PokemonType::GRASS,
                PokemonType::ELECTRIC,
                PokemonType::PSYCHIC,
                PokemonType::ICE,
                PokemonType::DRAGON,
                PokemonType::DARK,
                PokemonType::FAIRY,
            ]),
            'scriptData'  => json_encode([
                'instanceId' => $args['instanceId'],
            ]),
        ]));
    }

    private static function createTypeFilterVm(int $typeId, stdClass $query): stdClass
    {
        return (object) [
            'id'       => $typeId,
            'name'     => ViewModelFactory::createPokemonTypeName($typeId),
            'isActive' => array_key_exists('type', $query->filter)
                && $query->filter['type'] == $typeId,
        ];
    }

    private static function createPokemonVm(Pokemon $pokemon): stdClass
    {
        $config = require __DIR__ . "/../../../../../Config/Pokedex.php";

        $pokemonConfig = $config[$pokemon->number];

        return (object) [
            'id'             => $pokemon->id,
            'pokedexNumber'  => $pokemon->number,
            'name'           => $pokemonConfig['name'],
            'level'          => $pokemon->level,
            'sex'            => match ($pokemon->sex) {
                Sex::FEMALE  => "fa-venus",
                Sex::MALE    => "fa-mars",
                Sex::UNKNOWN => "fa-genderless",
            },
            'effectiveStats' => (object) [
                'hp'              => $pokemon->hp->calculate($pokemon->level),
                'physicalAttack'  => $pokemon->physicalAttack->calculate($pokemon->level),
                'physicalDefence' => $pokemon->physicalDefence->calculate($pokemon->level),
                'specialAttack'   => $pokemon->specialAttack->calculate($pokemon->level),
                'specialDefence'  => $pokemon->specialDefence->calculate($pokemon->level),
                'speed'           => $pokemon->speed->calculate($pokemon->level),
            ],
            'baseStats'      => (object) [
                'hp'              => $pokemon->hp->baseValue,
                'physicalAttack'  => $pokemon->physicalAttack->baseValue,
                'physicalDefence' => $pokemon->physicalDefence->baseValue,
                'specialAttack'   => $pokemon->specialAttack->baseValue,
                'specialDefence'  => $pokemon->specialDefence->baseValue,
                'speed'           => $pokemon->speed->baseValue,
            ],
            'geneticStats'   => (object) [
                'hp'              => self::createIvDeviationVm($pokemon->hp->iv),
                'physicalAttack'  => self::createIvDeviationVm($pokemon->physicalAttack->iv),
                'physicalDefence' => self::createIvDeviationVm($pokemon->physicalDefence->iv),
                'specialAttack'   => self::createIvDeviationVm($pokemon->specialAttack->iv),
                'specialDefence'  => self::createIvDeviationVm($pokemon->specialDefence->iv),
                'speed'           => self::createIvDeviationVm($pokemon->speed->iv),
            ],
        ];
    }

    private static function createIvDeviationVm(int $iv): stdClass
    {
        $deviation = $iv - 16;

        if ($deviation >= 0) {
            $deviation++;
        }

        return (object) [
            'class' => $deviation > 0 ? "positive" : "negative",
            'value' => ($deviation > 0 ? "+" : "") . round($deviation / 0.16),
        ];
    }
}
