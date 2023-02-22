<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\ViewModels\TeamMember;
use stdClass;

final class ViewModelFactory
{
    public function __construct(
        private readonly array $pokedex,
    ) {}

    public function createPokemonOnTeam(Pokemon $pokemon): stdClass
    {
        return (object) [
            'id' => $pokemon->id,
            'name' => $this->pokedex[$pokemon->number]['name'],
            'imageUrl' => TeamMember::createImageUrl($pokemon->number),
            'primaryType' => self::createPokemonTypeName($pokemon->primaryType),
            'secondaryType' => is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            'level' => strval($pokemon->level),
            'isShiny' => $pokemon->isShiny,
        ];
    }

    public function createPokemonInBattle(Pokemon $pokemon): PokemonVm
    {
        return new PokemonVm(
            $pokemon->id,
            $this->pokedex[$pokemon->number]['name'],
            TeamMember::createImageUrl($pokemon->number),
            self::createPokemonTypeName($pokemon->primaryType),
            is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            strval($pokemon->level),
            $pokemon->isShiny,
            strval($pokemon->remainingHp),
            strval($pokemon->calculateHp()),
        );
    }

    public static function createPokemonTypeName(int $type): string
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
            'name' => TrainerClass::getLabel($trainer->class) . ($trainer->name ? " {$trainer->name}" : ""),
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
            GymBadge::BOULDER => "/assets/badges/75px-Boulder_Badge.png",
            GymBadge::CASCADE => "/assets/badges/75px-Cascade_Badge.png",
            GymBadge::THUNDER => "/assets/badges/75px-Thunder_Badge.png",
            GymBadge::RAINBOW => "/assets/badges/75px-Rainbow_Badge.png",
            GymBadge::SOUL => "/assets/badges/75px-Soul_Badge.png",
            GymBadge::MARSH => "/assets/badges/75px-Marsh_Badge.png",
            GymBadge::VOLCANO => "/assets/badges/75px-Volcano_Badge.png",
            GymBadge::EARTH => "/assets/badges/75px-Earth_Badge.png",
        };
    }
}
