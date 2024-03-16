<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\PartyAssessment\Type;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels\RankedPokemonVm;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Exception;
use LogicException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPartyCombinations
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $query = (object) [
            'sort' => $request->query->get('sort') ?? "total",
        ];
        $registeredEntries = array_filter(
            $this->pokedexEntryRepository->all(),
            fn(PokemonEntry $entry) => $entry->isRegistered,
        );

        $registeredPokedexNumbers = array_map(
            fn(PokemonEntry $entry) => $entry->pokedexNumber,
            $registeredEntries,
        );

        $candidatePokemon = array_map(
            fn(string $pokedexNumber) => [
                'pokedexNumber' => $pokedexNumber,
                'type'          => $this->pokedexConfigRepository->find($pokedexNumber)['type'],
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
            $pokemonConfig = $this->pokedexConfigRepository->find($bestStats[$type]['pokedexNumber']);

            $vms[] = RankedPokemonVm::fromConfig(
                $bestStat['pokedexNumber'],
                $pokemonConfig,
                $bestStat['stats']
            );
        }

        return $vms;
    }

    private static function findBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../../../../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}
