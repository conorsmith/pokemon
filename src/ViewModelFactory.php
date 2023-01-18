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

    public function createGymBadge(GymBadge $gymBadge): stdClass
    {
        return (object) [
            'name' => $this->createGymBadgeName($gymBadge),
            'imageUrl' => $this->createGymBadgeImageUrl($gymBadge),
        ];
    }

    public function createGymBadgeName(GymBadge $gymBadge): string
    {
        $name = match ($gymBadge) {
            GymBadge::BOULDER => "Boulder",
            GymBadge::CASCADE => "Cascade",
            GymBadge::THUNDER => "Thunder",
            GymBadge::RAINBOW => "Rainbow",
            GymBadge::SOUL => "Soul",
            GymBadge::MARSH => "Marsh",
            GymBadge::VOLCANO => "Volcano",
            GymBadge::EARTH => "Earth",
        };

        return "{$name} Badge";
    }

    private function createGymBadgeImageUrl(GymBadge $gymBadge): string
    {
        return match ($gymBadge) {
            GymBadge::BOULDER => "https://archives.bulbagarden.net/media/upload/thumb/d/dd/Boulder_Badge.png/75px-Boulder_Badge.png",
            GymBadge::CASCADE => "https://archives.bulbagarden.net/media/upload/thumb/9/9c/Cascade_Badge.png/75px-Cascade_Badge.png",
            GymBadge::THUNDER => "https://archives.bulbagarden.net/media/upload/thumb/a/a6/Thunder_Badge.png/75px-Thunder_Badge.png",
            GymBadge::RAINBOW => "https://archives.bulbagarden.net/media/upload/thumb/b/b5/Rainbow_Badge.png/75px-Rainbow_Badge.png",
            GymBadge::SOUL => "https://archives.bulbagarden.net/media/upload/thumb/7/7d/Soul_Badge.png/75px-Soul_Badge.png",
            GymBadge::MARSH => "https://archives.bulbagarden.net/media/upload/thumb/6/6b/Marsh_Badge.png/75px-Marsh_Badge.png",
            GymBadge::VOLCANO => "https://archives.bulbagarden.net/media/upload/thumb/1/12/Volcano_Badge.png/75px-Volcano_Badge.png",
            GymBadge::EARTH => "https://archives.bulbagarden.net/media/upload/thumb/7/78/Earth_Badge.png/75px-Earth_Badge.png",
        };
    }
}
