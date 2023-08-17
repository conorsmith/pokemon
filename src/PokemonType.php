<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class PokemonType
{
    public const NORMAL = 1;
    public const FIGHTING = 2;
    public const FLYING = 3;
    public const POISON = 4;
    public const GROUND = 5;
    public const ROCK = 6;
    public const BUG = 7;
    public const GHOST = 8;
    public const STEEL = 9;
    public const FIRE = 10;
    public const WATER = 11;
    public const GRASS = 12;
    public const ELECTRIC = 13;
    public const PSYCHIC = 14;
    public const ICE = 15;
    public const DRAGON = 16;
    public const DARK = 17;
    public const FAIRY = 18;

    private const MULTIPLIERS = [
        self::NORMAL => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 0.5,
            self::BUG => 1,
            self::GHOST => 0,
            self::STEEL => 0.5,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::FIGHTING => [
            self::NORMAL => 2,
            self::FIGHTING => 1,
            self::FLYING => 0.5,
            self::POISON => 0.5,
            self::GROUND => 1,
            self::ROCK => 2,
            self::BUG => 0.5,
            self::GHOST => 0,
            self::STEEL => 2,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 0.5,
            self::ICE => 2,
            self::DRAGON => 1,
            self::DARK => 2,
            self::FAIRY => 0.5,
        ],
        self::FLYING => [
            self::NORMAL => 1,
            self::FIGHTING => 2,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 0.5,
            self::BUG => 2,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 2,
            self::ELECTRIC => 0.5,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::POISON => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 0.5,
            self::GROUND => 0.5,
            self::ROCK => 0.5,
            self::BUG => 1,
            self::GHOST => 0.5,
            self::STEEL => 0,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 2,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 2,
        ],
        self::GROUND => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 0,
            self::POISON => 2,
            self::GROUND => 1,
            self::ROCK => 2,
            self::BUG => 0.5,
            self::GHOST => 1,
            self::STEEL => 2,
            self::FIRE => 2,
            self::WATER => 1,
            self::GRASS => 0.5,
            self::ELECTRIC => 2,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::ROCK => [
            self::NORMAL => 1,
            self::FIGHTING => 0.5,
            self::FLYING => 2,
            self::POISON => 1,
            self::GROUND => 0.5,
            self::ROCK => 1,
            self::BUG => 2,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 2,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 2,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::BUG => [
            self::NORMAL => 1,
            self::FIGHTING => 0.5,
            self::FLYING => 0.5,
            self::POISON => 0.5,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 0.5,
            self::STEEL => 0.5,
            self::FIRE => 0.5,
            self::WATER => 1,
            self::GRASS => 2,
            self::ELECTRIC => 1,
            self::PSYCHIC => 2,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 2,
            self::FAIRY => 0.5,
        ],
        self::GHOST => [
            self::NORMAL => 0,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 2,
            self::STEEL => 1,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 2,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 0.5,
            self::FAIRY => 1,
        ],
        self::STEEL => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 2,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 0.5,
            self::WATER => 0.5,
            self::GRASS => 1,
            self::ELECTRIC => 0.5,
            self::PSYCHIC => 1,
            self::ICE => 2,
            self::DRAGON => 1,
            self::DARK => 1,
            self::FAIRY => 2,
        ],
        self::FIRE => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 0.5,
            self::BUG => 2,
            self::GHOST => 1,
            self::STEEL => 2,
            self::FIRE => 0.5,
            self::WATER => 0.5,
            self::GRASS => 2,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 2,
            self::DRAGON => 0.5,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::WATER => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 2,
            self::ROCK => 2,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 1,
            self::FIRE => 2,
            self::WATER => 0.5,
            self::GRASS => 0.5,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 0.5,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::GRASS => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 0.5,
            self::POISON => 0.5,
            self::GROUND => 2,
            self::ROCK => 2,
            self::BUG => 0.5,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 0.5,
            self::WATER => 2,
            self::GRASS => 0.5,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 0.5,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::ELECTRIC => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 2,
            self::POISON => 1,
            self::GROUND => 0,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 1,
            self::FIRE => 1,
            self::WATER => 2,
            self::GRASS => 0.5,
            self::ELECTRIC => 0.5,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 0.5,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::PSYCHIC => [
            self::NORMAL => 1,
            self::FIGHTING => 2,
            self::FLYING => 1,
            self::POISON => 2,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 0.5,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 0,
            self::FAIRY => 1,
        ],
        self::ICE => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 2,
            self::POISON => 1,
            self::GROUND => 2,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 0.5,
            self::WATER => 0.5,
            self::GRASS => 2,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 0.5,
            self::DRAGON => 2,
            self::DARK => 1,
            self::FAIRY => 1,
        ],
        self::DRAGON => [
            self::NORMAL => 1,
            self::FIGHTING => 1,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 2,
            self::DARK => 1,
            self::FAIRY => 0,
        ],
        self::DARK => [
            self::NORMAL => 1,
            self::FIGHTING => 0.5,
            self::FLYING => 1,
            self::POISON => 1,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 2,
            self::STEEL => 1,
            self::FIRE => 1,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 2,
            self::ICE => 1,
            self::DRAGON => 1,
            self::DARK => 0.5,
            self::FAIRY => 0.5,
        ],
        self::FAIRY => [
            self::NORMAL => 1,
            self::FIGHTING => 2,
            self::FLYING => 1,
            self::POISON => 0.5,
            self::GROUND => 1,
            self::ROCK => 1,
            self::BUG => 1,
            self::GHOST => 1,
            self::STEEL => 0.5,
            self::FIRE => 0.5,
            self::WATER => 1,
            self::GRASS => 1,
            self::ELECTRIC => 1,
            self::PSYCHIC => 1,
            self::ICE => 1,
            self::DRAGON => 2,
            self::DARK => 2,
            self::FAIRY => 1,
        ],
    ];

    public static function getMultiplier(int $attack, int $defence): float
    {
        return floatval(self::MULTIPLIERS[$attack][$defence]);
    }

    public static function getAttackingMultipliers(int $attack): array
    {
        return array_map(fn($multiplier) => floatval($multiplier), self::MULTIPLIERS[$attack]);
    }

    public static function getDefendingMultipliers(int $defence): array
    {
        $defendingMultipliers = [];

        foreach (self::MULTIPLIERS as $attack => $attackingMultipliers) {
            $defendingMultipliers[$attack] = floatval($attackingMultipliers[$defence]);
        }

        return $defendingMultipliers;
    }
}
