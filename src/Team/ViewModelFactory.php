<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team;

use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use stdClass;

final class ViewModelFactory
{
    public static function createPokemonStatsViewModel(PokemonEntry $entry, array $config, array $stats): stdClass
    {
        return (object) [
            'pokedexNumber'    => $entry->pokedexNumber,
            'name'             => $config['name'],
            'imageUrl'         => TeamMember::createImageUrl($entry->pokedexNumber),
            'primaryType'      => SharedViewModelFactory::createPokemonTypeName($config['type'][0]),
            'secondaryType'    => isset($config['type'][1])
                ? SharedViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
            'stats' => (object) [
                'total' => array_sum($stats),
                'hp' => $stats['hp'],
                'physicalAttack' => $stats['attack'],
                'physicalDefence' => $stats['defence'],
                'specialAttack' => $stats['spAttack'],
                'specialDefence' => $stats['spDefence'],
                'speed' => $stats['speed'],
            ],
        ];
    }
}