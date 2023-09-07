<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Controllers;

use ConorSmith\Pokemon\Party\Domain\Type;
use ConorSmith\Pokemon\Party\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Party\ViewModelFactory;
use ConorSmith\Pokemon\SharedKernel\Queries\RegisteredPokedexNumbersQuery;
use ConorSmith\Pokemon\TemplateEngine;
use Exception;
use LogicException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyCombinations
{
    public function __construct(
        private readonly RegisteredPokedexNumbersQuery $registeredPokedexNumbersQuery,
        private readonly PokemonConfigRepository $pokemonConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $query = (object) [
            'sort' => $request->query->get('sort') ?? "total",
        ];

        $registeredPokedexNumbers = $this->registeredPokedexNumbersQuery->run();

        $candidatePokemon = array_map(
            fn(string $pokedexNumber) => [
                'pokedexNumber' => $pokedexNumber,
                'type'          => $this->pokemonConfigRepository->find($pokedexNumber)['type'],
                'stats'         => self::findBaseStats($pokedexNumber),
            ],
            $registeredPokedexNumbers,
        );

        $bestStatsByType = [
            'total'     => [],
            'hp'        => [],
            'attack'    => [],
            'defence'   => [],
            'spAttack'  => [],
            'spDefence' => [],
            'speed'     => [],
        ];

        foreach ($candidatePokemon as $pokemon) {
            unset($pokemon['stats']['number']);
            $type = $pokemon['type'];
            sort($type);
            $typeKey = implode("-", $type);
            foreach ($bestStatsByType as $statKey => $bestStats) {
                if (!isset($bestStatsByType[$statKey][$typeKey])) {
                    $bestStatsByType[$statKey][$typeKey] = $pokemon;
                } else {
                    if ($statKey === "total") {
                        if (array_sum($bestStatsByType[$statKey][$typeKey]['stats']) < array_sum($pokemon['stats'])) {
                            $bestStatsByType[$statKey][$typeKey] = $pokemon;
                        }
                    } else {
                        if ($bestStatsByType[$statKey][$typeKey]['stats'][$statKey] < $pokemon['stats'][$statKey]) {
                            $bestStatsByType[$statKey][$typeKey] = $pokemon;
                        }
                    }
                }
            }
        }

        foreach ($bestStatsByType as $statKey => $bestStats) {
            uasort($bestStatsByType[$statKey], function ($a, $b) use ($statKey) {
                if ($statKey === "total") {
                    return array_sum($a['stats']) < array_sum($b['stats']) ? 1 : -1;
                } else {
                    return $a['stats'][$statKey] < $b['stats'][$statKey] ? 1 : -1;
                }
            });
        }

        $availableTypes = [];

        foreach ($bestStatsByType['total'] as $key => $stats) {
            $keyParts = explode("-", strval($key));
            $availableTypes[] = new Type(
                intval($keyParts[0]),
                isset($keyParts[1]) ? intval($keyParts[1]) : null
            );
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/PartyCombinations.php", [
            'query'          => $query,
            'availableTypes' => count($availableTypes),
            'options'        => $this->createBestStatsVm($bestStatsByType[match($query->sort) {
                'total' => "total",
                'hp'    => "hp",
                'pa'    => "attack",
                'pd'    => "defence",
                'sa'    => "spAttack",
                'sd'    => "spDefence",
                'sp'    => "speed",
                default => throw new LogicException(),
            }]),
        ]));
    }

    private function createBestStatsVm(array $bestStats): array
    {
        $vms = [];

        foreach ($bestStats as $type => $bestStat) {
            $pokemonConfig = $this->pokemonConfigRepository->find($bestStats[$type]['pokedexNumber']);

            $vms[] = ViewModelFactory::createPokemonStatsViewModel(
                $bestStat['pokedexNumber'],
                $pokemonConfig,
                $bestStat['stats']
            );
        }

        return $vms;
    }

    private static function findBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}
