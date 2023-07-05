<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\ViewModels\IvStrength;
use ConorSmith\Pokemon\Battle\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
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
            'form' => $pokemon->form,
            'imageUrl' => TeamMember::createImageUrl($pokemon->number, $pokemon->form),
            'primaryType' => self::createPokemonTypeName($pokemon->primaryType),
            'secondaryType' => is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            'level' => strval($pokemon->level),
            'isShiny' => $pokemon->isShiny,
        ];
    }

    public function createPokemonInBattle(Pokemon $pokemon): PokemonVm
    {
        RandomNumberGenerator::setSeed(crc32($pokemon->id));

        $ivStrength = new IvStrength(
            $pokemon->stats->calculateTotalStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateOffensiveStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateDefensiveStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateAttackStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateDefenceStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->ivPhysicalAttack / 31,
            $pokemon->stats->ivPhysicalDefence / 31,
            $pokemon->stats->ivSpecialAttack / 31,
            $pokemon->stats->ivSpecialDefence / 31,
            $pokemon->stats->ivSpeed / 31,
            $pokemon->stats->ivHp / 31,
        );

        RandomNumberGenerator::unsetSeed();

        return new PokemonVm(
            $pokemon->id,
            $this->pokedex[$pokemon->number]['name'],
            $pokemon->form,
            TeamMember::createImageUrl($pokemon->number, $pokemon->form),
            self::createPokemonTypeName($pokemon->primaryType),
            is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            strval($pokemon->level),
            $pokemon->sex,
            $pokemon->isShiny,
            strval($pokemon->remainingHp),
            strval($pokemon->calculateHp()),
            $pokemon->remainingHp === 0,
            $pokemon->stats->calculatePhysicalAttack(),
            $pokemon->stats->calculateSpecialAttack(),
            $ivStrength,
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

    public function createTrainerInBattle(Trainer $trainer, string $imageUrl): stdClass
    {
        return (object) [
            'name' => TrainerClass::getLabel($trainer->class) . ($trainer->name ? " {$trainer->name}" : ""),
            'imageUrl' => $imageUrl,
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
            GymBadge::ZEPHYR => "Zephyr",
            GymBadge::HIVE => "Hive",
            GymBadge::PLAIN => "Plain",
            GymBadge::FOG => "Fog",
            GymBadge::STORM => "Storm",
            GymBadge::MINERAL => "Mineral",
            GymBadge::GLACIER => "Glacier",
            GymBadge::RISING => "Rising",
            GymBadge::STONE => "Stone",
            GymBadge::KNUCKLE => "Knuckle",
            GymBadge::DYNAMO => "Dynamo",
            GymBadge::HEAT => "Heat",
            GymBadge::BALANCE => "Balance",
            GymBadge::FEATHER => "Feather",
            GymBadge::MIND => "Mind",
            GymBadge::RAIN => "Rain",
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
            GymBadge::ZEPHYR => "/assets/badges/75px-Zephyr_Badge.png",
            GymBadge::HIVE => "/assets/badges/75px-Hive_Badge.png",
            GymBadge::PLAIN => "/assets/badges/75px-Plain_Badge.png",
            GymBadge::FOG => "/assets/badges/75px-Fog_Badge.png",
            GymBadge::STORM => "/assets/badges/75px-Storm_Badge.png",
            GymBadge::MINERAL => "/assets/badges/75px-Mineral_Badge.png",
            GymBadge::GLACIER => "/assets/badges/75px-Glacier_Badge.png",
            GymBadge::RISING => "/assets/badges/75px-Rising_Badge.png",
        };
    }
}
