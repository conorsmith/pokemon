<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\ViewModels;

use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\FormEntry;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\ViewModelFactory;

final class PokemonEntryVm
{
    public static function create(PokemonEntry $entry, array $config): self
    {
        return new self(
            $entry->pokedexNumber,
            $entry->regionId->value,
            $config['name'],
            ViewModelFactory::createPokemonImageUrl($entry->pokedexNumber),
            ViewModelFactory::createPokemonTypeName($config['type'][0]),
            isset($config['type'][1])
                ? ViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
            count($entry->forms) > 0,
            array_map(
                fn(FormEntry $formEntry) => $formEntry->isRegistered
                    ? PokemonFormEntryVm::create($entry, $formEntry, $config)
                    : null,
                $entry->forms,
            ),
        );
    }

    public function __construct(
        public readonly string $pokedexNumber,
        public readonly string $regionId,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly string $secondaryType,
        public readonly bool $hasMultipleForms,
        public readonly array $forms,
    ) {}
}
