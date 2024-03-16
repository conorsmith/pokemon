<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\FormEntry;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\ViewModelFactory;

final class PokemonFormEntryVm
{
    public static function create(PokemonEntry $entry, FormEntry $formEntry, array $config): self
    {
        return new self(
            $config['name'],
            $formEntry->id,
            ViewModelFactory::createPokemonImageUrl($entry->pokedexNumber, $formEntry->id),
            ViewModelFactory::createPokemonTypeName($config['type'][0]),
            isset($config['type'][1])
                ? ViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
        );
    }

    public function __construct(
        public readonly string $name,
        public readonly string $form,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly string $secondaryType,
    ) {}
}
