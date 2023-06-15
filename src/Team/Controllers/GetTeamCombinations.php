<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Controllers;

use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Team\Domain\Type;
use ConorSmith\Pokemon\Team\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Team\ViewModelFactory;
use ConorSmith\Pokemon\TemplateEngine;

final class GetTeamCombinations
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokemonConfigRepository $pokemonConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $query = (object) [
            'sort' => $_GET['sort'] ?? "total",
        ];

        $pokedexEntries = array_filter(
            $this->pokedexEntryRepository->all(),
            fn(PokemonEntry $entry) => $entry->isRegistered,
        );

        $candidatePokemon = array_map(
            fn(PokemonEntry $entry) => [
                'pokedexNumber' => $entry->pokedexNumber,
                'pokedexEntry'  => $entry,
                'type'          => $this->pokemonConfigRepository->find($entry->pokedexNumber)['type'],
                'stats'         => self::findBaseStats($entry->pokedexNumber),
            ],
            $pokedexEntries,
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
                    return array_sum($a['stats']) < array_sum($b['stats']);
                } else {
                    return $a['stats'][$statKey] < $b['stats'][$statKey];
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

        echo $this->templateEngine->render(__DIR__ . "/../Templates/TeamCombinations.php", [
            'query' => $query,
            'availableTypes' => count($availableTypes),
            'options' => $this->createBestStatsVm($bestStatsByType[match($query->sort) {
                'total' => "total",
                'hp' => "hp",
                'pa' => "attack",
                'pd' => "defence",
                'sa' => "spAttack",
                'sd' => "spDefence",
                'sp' => "speed",
            }]),
        ]);
    }

    private function createBestStatsVm(array $bestStats): array
    {
        $vms = [];

        foreach ($bestStats as $type => $bestStat) {
            $pokemonConfig = $this->pokemonConfigRepository->find($bestStats[$type]['pokedexEntry']->pokedexNumber);

            $vms[] = ViewModelFactory::createPokemonStatsViewModel(
                $bestStat['pokedexEntry'],
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
