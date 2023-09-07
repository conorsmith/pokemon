<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party;

use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use stdClass;

final class ViewModelFactory
{
    public static function createPokemonStatsViewModel(string $pokedexNumber, array $config, array $stats): stdClass
    {
        return (object) [
            'pokedexNumber' => $pokedexNumber,
            'name'          => $config['name'],
            'imageUrl'      => SharedViewModelFactory::createPokemonImageUrl($pokedexNumber),
            'primaryType'   => SharedViewModelFactory::createPokemonTypeName($config['type'][0]),
            'secondaryType' => isset($config['type'][1])
                ? SharedViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
            'stats'         => (object) [
                'total'           => array_sum($stats),
                'hp'              => $stats['hp'],
                'physicalAttack'  => $stats['attack'],
                'physicalDefence' => $stats['defence'],
                'specialAttack'   => $stats['spAttack'],
                'specialDefence'  => $stats['spDefence'],
                'speed'           => $stats['speed'],
            ],
        ];
    }
}