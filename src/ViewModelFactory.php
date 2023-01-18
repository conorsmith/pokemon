<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Domain\Battle\Trainer;
use ConorSmith\Pokemon\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\ViewModels\Battle\Pokemon as PokemonVm;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use stdClass;

final class ViewModelFactory
{
    public function __construct(
        private readonly array $pokedex,
    ) {}

    public function createPokemonOnTeam(Pokemon $pokemon): PokemonVm
    {
        return new PokemonVm(
            $this->pokedex[$pokemon->number]['name'],
            TeamMember::createImageUrl($pokemon->number),
            self::createPokemonTypeName($pokemon->primaryType),
            is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            strval($pokemon->level),
        );
    }

    public function createPokemonInBattle(Pokemon $pokemon): PokemonVm
    {
        return new PokemonVm(
            $this->pokedex[$pokemon->number]['name'],
            TeamMember::createImageUrl($pokemon->number),
            self::createPokemonTypeName($pokemon->primaryType),
            is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            strval($pokemon->level),
        );
    }

    private static function createPokemonTypeName(int $type): string
    {
        return match($type) {
            PokemonType::NORMAL => "normal",
            PokemonType::FIGHTING => "fighting",
            PokemonType::FLYING => "flying",
            PokemonType::POISON => "poison",
            PokemonType::GROUND => "ground",
            PokemonType::ROCK => "rock",
            PokemonType::BUG => "bug",
            PokemonType::GHOST => "ghost",
            PokemonType::STEEL => "steel",
            PokemonType::FIRE => "fire",
            PokemonType::WATER => "water",
            PokemonType::GRASS => "grass",
            PokemonType::ELECTRIC => "electric",
            PokemonType::PSYCHIC => "psychic",
            PokemonType::ICE => "ice",
            PokemonType::DRAGON => "dragon",
            PokemonType::DARK => "dark",
            PokemonType::FAIRY => "fairy",
        };
    }

    public function createTrainerInBattle(Trainer $trainer): stdClass
    {
        return (object) [
            'name' => $trainer->name,
            'team' => (object) [
                'fainted' => $trainer->countFaintedTeamMembers(),
                'active' => $trainer->countActiveTeamMembers(),
            ]
        ];
    }
}
