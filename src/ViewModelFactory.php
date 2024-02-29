<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\ViewModels\IvStrength;
use ConorSmith\Pokemon\Battle\ViewModels\Pokemon as PokemonVm;
use ConorSmith\Pokemon\SharedKernel\Domain\GymBadge;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use LogicException;
use stdClass;

final class ViewModelFactory
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function createPokemonInBattle(Pokemon $pokemon): PokemonVm
    {
        RandomNumberGenerator::setSeed(crc32($pokemon->id));

        $ivStrength = new IvStrength(
            $pokemon->stats->calculateTotalIvStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateOffensiveIvStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateDefensiveIvStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateAttackIvStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->calculateDefenceIvStrength(RandomNumberGenerator::generateInRange(-2, 2)),
            $pokemon->stats->ivs->physicalAttack / 31,
            $pokemon->stats->ivs->physicalDefence / 31,
            $pokemon->stats->ivs->specialAttack / 31,
            $pokemon->stats->ivs->specialDefence / 31,
            $pokemon->stats->ivs->speed / 31,
            $pokemon->stats->ivs->hp / 31,
        );

        RandomNumberGenerator::unsetSeed();

        $pokemonConfigEntry = $this->pokedexConfigRepository->find($pokemon->number);

        return new PokemonVm(
            $pokemon->id,
            $pokemonConfigEntry['name'],
            $pokemon->form,
            self::createPokemonImageUrl($pokemon->number, $pokemon->form),
            self::createPokemonTypeName($pokemon->primaryType),
            is_null($pokemon->secondaryType) ? null : self::createPokemonTypeName($pokemon->secondaryType),
            strval($pokemon->level),
            $pokemon->sex,
            $pokemon->isShiny,
            isset($pokemonConfigEntry['isLegendary']) && $pokemonConfigEntry['isLegendary'],
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
            PokemonType::NORMAL   => "normal",
            PokemonType::FIGHTING => "fighting",
            PokemonType::FLYING   => "flying",
            PokemonType::POISON   => "poison",
            PokemonType::GROUND   => "ground",
            PokemonType::ROCK     => "rock",
            PokemonType::BUG      => "bug",
            PokemonType::GHOST    => "ghost",
            PokemonType::STEEL    => "steel",
            PokemonType::FIRE     => "fire",
            PokemonType::WATER    => "water",
            PokemonType::GRASS    => "grass",
            PokemonType::ELECTRIC => "electric",
            PokemonType::PSYCHIC  => "psychic",
            PokemonType::ICE      => "ice",
            PokemonType::DRAGON   => "dragon",
            PokemonType::DARK     => "dark",
            PokemonType::FAIRY    => "fairy",
            default               => throw new LogicException(),
        };
    }

    public function createTrainerInBattle(Trainer $trainer, string $imageUrl): stdClass
    {
        return (object) [
            'name'     => TrainerClass::getLabel($trainer->class) . ($trainer->name ? " {$trainer->name}" : ""),
            'imageUrl' => $imageUrl,
            'party'    => (object) [
                'fainted' => $trainer->countFaintedPartyMembers(),
                'active'  => $trainer->countActivePartyMembers(),
            ]
        ];
    }

    public function createGymBadge(GymBadge $gymBadge): stdClass
    {
        return (object) [
            'name'     => $this->createGymBadgeName($gymBadge),
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
            GymBadge::SOUL    => "Soul",
            GymBadge::MARSH   => "Marsh",
            GymBadge::VOLCANO => "Volcano",
            GymBadge::EARTH   => "Earth",
            GymBadge::ZEPHYR  => "Zephyr",
            GymBadge::HIVE    => "Hive",
            GymBadge::PLAIN   => "Plain",
            GymBadge::FOG     => "Fog",
            GymBadge::STORM   => "Storm",
            GymBadge::MINERAL => "Mineral",
            GymBadge::GLACIER => "Glacier",
            GymBadge::RISING  => "Rising",
            GymBadge::STONE   => "Stone",
            GymBadge::KNUCKLE => "Knuckle",
            GymBadge::DYNAMO  => "Dynamo",
            GymBadge::HEAT    => "Heat",
            GymBadge::BALANCE => "Balance",
            GymBadge::FEATHER => "Feather",
            GymBadge::MIND    => "Mind",
            GymBadge::RAIN    => "Rain",
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
            GymBadge::SOUL    => "/assets/badges/75px-Soul_Badge.png",
            GymBadge::MARSH   => "/assets/badges/75px-Marsh_Badge.png",
            GymBadge::VOLCANO => "/assets/badges/75px-Volcano_Badge.png",
            GymBadge::EARTH   => "/assets/badges/75px-Earth_Badge.png",
            GymBadge::ZEPHYR  => "/assets/badges/75px-Zephyr_Badge.png",
            GymBadge::HIVE    => "/assets/badges/75px-Hive_Badge.png",
            GymBadge::PLAIN   => "/assets/badges/75px-Plain_Badge.png",
            GymBadge::FOG     => "/assets/badges/75px-Fog_Badge.png",
            GymBadge::STORM   => "/assets/badges/75px-Storm_Badge.png",
            GymBadge::MINERAL => "/assets/badges/75px-Mineral_Badge.png",
            GymBadge::GLACIER => "/assets/badges/75px-Glacier_Badge.png",
            GymBadge::RISING  => "/assets/badges/75px-Rising_Badge.png",
            GymBadge::STONE   => "/assets/badges/75px-Stone_Badge.png",
            GymBadge::KNUCKLE => "/assets/badges/75px-Knuckle_Badge.png",
            GymBadge::DYNAMO  => "/assets/badges/75px-Dynamo_Badge.png",
            GymBadge::HEAT    => "/assets/badges/75px-Heat_Badge.png",
            GymBadge::BALANCE => "/assets/badges/75px-Balance_Badge.png",
            GymBadge::FEATHER => "/assets/badges/75px-Feather_Badge.png",
            GymBadge::MIND    => "/assets/badges/75px-Mind_Badge.png",
            GymBadge::RAIN    => "/assets/badges/75px-Rain_Badge.png",
        };
    }

    public static function createPokemonImageUrl(string $id, ?string $form = null): string
    {
        if ($id === PokedexNo::UNOWN && !is_null($form)) {
            return self::createUnownImageUrl($form);
        }

        $paddedPokemonId = str_pad($id, 3, "0", STR_PAD_LEFT);
        return "/assets/pokemon/{$paddedPokemonId}.png";
    }

    private static function createUnownImageUrl(string $form): string
    {
        return "/assets/forms/" .  match ($form) {
                "A"     => "HOME0201.png",
                "B"     => "HOME0201B.png",
                "C"     => "HOME0201C.png",
                "D"     => "HOME0201D.png",
                "E"     => "HOME0201E.png",
                "F"     => "HOME0201F.png",
                "G"     => "HOME0201G.png",
                "H"     => "HOME0201H.png",
                "I"     => "HOME0201I.png",
                "J"     => "HOME0201J.png",
                "K"     => "HOME0201K.png",
                "L"     => "HOME0201L.png",
                "M"     => "HOME0201M.png",
                "N"     => "HOME0201N.png",
                "O"     => "HOME0201O.png",
                "P"     => "HOME0201P.png",
                "Q"     => "HOME0201Q.png",
                "R"     => "HOME0201R.png",
                "S"     => "HOME0201S.png",
                "T"     => "HOME0201T.png",
                "U"     => "HOME0201U.png",
                "V"     => "HOME0201V.png",
                "W"     => "HOME0201W.png",
                "X"     => "HOME0201X.png",
                "Y"     => "HOME0201Y.png",
                "Z"     => "HOME0201Z.png",
                "!"     => "HOME0201EX.png",
                "?"     => "HOME0201QU.png",
                default => throw new LogicException(),
            };
    }
}
