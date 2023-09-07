<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\ViewModels;

use ConorSmith\Pokemon\Party\Domain\EggGroup;
use ConorSmith\Pokemon\Party\Domain\Pokemon as DomainModel;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\ViewModelFactory;
use stdClass;

final class BreedingPokemon
{
    public static function create(DomainModel $pokemon): self
    {
        $config = new PokedexConfigRepository();

        $pokemonConfig = $config->find($pokemon->number);

        return new self(
            $pokemon->id,
            $pokemonConfig['name'],
            $pokemon->form,
            match ($pokemon->sex) {
                Sex::FEMALE  => "fa-venus",
                Sex::MALE    => "fa-mars",
                Sex::UNKNOWN => "fa-genderless",
            },
            ViewModelFactory::createPokemonImageUrl($pokemon->number, $pokemon->form),
            ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][0]),
            isset($pokemonConfig['type'][1]) ? ViewModelFactory::createPokemonTypeName($pokemonConfig['type'][1]) : null,
            strval($pokemon->level),
            $pokemon->isShiny,
            self::createEggGroupName($pokemonConfig['eggGroups'][0]),
            isset($pokemonConfig['eggGroups'][1]) ? self::createEggGroupName($pokemonConfig['eggGroups'][1]) : null,
            (object) [
                'physicalAttack'  => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->physicalAttack->iv),
                ],
                'specialAttack'   => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->specialAttack->iv),
                ],
                'physicalDefence' => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->physicalDefence->iv),
                ],
                'specialDefence'  => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->specialDefence->iv),
                ],
                'speed'           => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->speed->iv),
                ],
                'hp'              => (object) [
                    'ivDeviation' => self::createIvDeviationVm($pokemon->hp->iv),
                ],
            ],
        );
    }

    private static function createEggGroupName(EggGroup $eggGroup): string
    {
        return match ($eggGroup) {
            EggGroup::AMORPHOUS          => "amorphous",
            EggGroup::BUG                => "bug",
            EggGroup::DRAGON             => "dragon",
            EggGroup::FAIRY              => "fairy",
            EggGroup::FIELD              => "field",
            EggGroup::FLYING             => "flying",
            EggGroup::GRASS              => "grass",
            EggGroup::HUMAN_LIKE         => "human-like",
            EggGroup::MINERAL            => "mineral",
            EggGroup::MONSTER            => "monster",
            EggGroup::WATER_1            => "water-1",
            EggGroup::WATER_2            => "water-2",
            EggGroup::WATER_3            => "water-3",
            EggGroup::NO_EGGS_DISCOVERED => "no-eggs-discovered",
            EggGroup::DITTO              => "ditto",
        };
    }

    private static function createIvDeviationVm(int $iv): stdClass
    {
        $deviation = $iv - 16;

        if ($deviation >= 0) {
            $deviation++;
        }

        return (object) [
            'class' => $deviation > 0 ? "positive" : "negative",
            'value' => ($deviation > 0 ? "+" : "") . round($deviation / 0.16) . "%",
        ];
    }

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly ?string $form,
        public readonly string $sexIcon,
        public readonly string $imageUrl,
        public readonly string $primaryType,
        public readonly ?string $secondaryType,
        public readonly string $level,
        public readonly bool $isShiny,
        public readonly string $firstEggGroup,
        public readonly ?string $secondEggGroup,
        public readonly stdClass $stats,
    ) {}
}
