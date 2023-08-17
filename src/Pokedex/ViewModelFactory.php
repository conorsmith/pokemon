<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex;

use ConorSmith\Pokemon\Pokedex\Domain\FormEntry;
use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use stdClass;

final class ViewModelFactory
{
    public static function createPokemonViewModel(PokemonEntry $entry, array $config): stdClass
    {
        return (object) [
            'pokedexNumber'    => $entry->pokedexNumber,
            'regionId'         => $entry->regionId->value,
            'name'             => $config['name'],
            'imageUrl'         => TeamMember::createImageUrl($entry->pokedexNumber),
            'primaryType'      => SharedViewModelFactory::createPokemonTypeName($config['type'][0]),
            'secondaryType'    => isset($config['type'][1])
                ? SharedViewModelFactory::createPokemonTypeName($config['type'][1])
                : "",
            'hasMultipleForms' => count($entry->forms) > 0,
            'forms'            => self::createFormViewModels($entry, $config),
        ];
    }

    private static function createFormViewModels(PokemonEntry $entry, array $config): array
    {
        $formVms = [];

        /** @var FormEntry $form */
        foreach ($entry->forms as $form) {
            if ($form->isRegistered) {
                $formVms[] = (object) [
                    'name'          => $config['name'],
                    'form'          => $form->id,
                    'imageUrl'      => TeamMember::createImageUrl($entry->pokedexNumber, $form->id),
                    'primaryType'   => SharedViewModelFactory::createPokemonTypeName($config['type'][0]),
                    'secondaryType' => isset($config['type'][1])
                        ? SharedViewModelFactory::createPokemonTypeName($config['type'][1])
                        : "",
                ];
            } else {
                $formVms[] = null;
            }
        }

        return $formVms;
    }
}