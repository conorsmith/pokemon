<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Party\ViewModels;

use ConorSmith\Pokemon\ViewModelFactory;

final class RankedPokemonVm
{
    public static function fromConfig(string $pokedexNumber, array $config, array $stats): self
    {
        return new self(
            $pokedexNumber,
            $config['name'],
            ViewModelFactory::createPokemonImageUrl($pokedexNumber),
            ViewModelFactory::createPokemonTypeName($config['type'][0]),
            isset($config['type'][1])
                ? ViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
            new PokemonStatsVm(
                strval(array_sum($stats)),
                strval($stats['hp']),
                strval($stats['attack']),
                strval($stats['defence']),
                strval($stats['spAttack']),
                strval($stats['spDefence']),
                strval($stats['speed']),
            ),
        );
    }

    public function __construct(
        public readonly string $pokedexNumber,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly string $secondaryType,
        public readonly PokemonStatsVm $stats,
    ) {}
}
