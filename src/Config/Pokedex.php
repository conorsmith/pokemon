<?php

declare(strict_types=1);

use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\PokemonType;
use ConorSmith\Pokemon\ItemId;

return [
    PokedexNo::BULBASAUR => [
        'name' => "Bulbasaur",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::IVYSAUR => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::IVYSAUR => [
        'name' => "Ivysaur",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::VENUSAUR => [
                'level' => 32,
            ],
        ],
    ],
    PokedexNo::VENUSAUR => [
        'name' => "Venusaur",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
    ],
    PokedexNo::CHARMANDER => [
        'name' => "Charmander",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::CHARMELEON => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::CHARMELEON => [
        'name' => "Charmeleon",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::CHARIZARD => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::CHARIZARD => [
        'name' => "Charizard",
        'type' => [PokemonType::FIRE, PokemonType::FLYING],
    ],
    PokedexNo::SQUIRTLE => [
        'name' => "Squirtle",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::WARTORTLE => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::WARTORTLE => [
        'name' => "Wartortle",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::BLASTOISE => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::BLASTOISE => [
        'name' => "Blastoise",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::CATERPIE => [
        'name' => "Caterpie",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::METAPOD => [
                'level' => 7,
            ],
        ],
    ],
    PokedexNo::METAPOD => [
        'name' => "Metapod",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::BUTTERFREE => [
                'level' => 10,
            ],
        ],
    ],
    PokedexNo::BUTTERFREE => [
        'name' => "Butterfree",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::WEEDLE => [
        'name' => "Weedle",
        'type' => [PokemonType::BUG, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::KAKUNA => [
                'level' => 7,
            ],
        ],
    ],
    PokedexNo::KAKUNA => [
        'name' => "Kakuna",
        'type' => [PokemonType::BUG, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::BEEDRILL => [
                'level' => 10,
            ],
        ],
    ],
    PokedexNo::BEEDRILL => [
        'name' => "Beedrill",
        'type' => [PokemonType::BUG, PokemonType::POISON],
    ],
    PokedexNo::PIDGEY => [
        'name' => "Pidgey",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::PIDGEOTTO => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::PIDGEOTTO => [
        'name' => "Pidgeotto",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::PIDGEOT => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::PIDGEOT => [
        'name' => "Pidgeot",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::RATTATA => [
        'name' => "Rattata",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::RATICATE => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::RATICATE => [
        'name' => "Raticate",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::SPEAROW => [
        'name' => "Spearow",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::FEAROW => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::FEAROW => [
        'name' => "Fearow",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::EKANS => [
        'name' => "Ekans",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::ARBOK => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::ARBOK => [
        'name' => "Arbok",
        'type' => [PokemonType::POISON],
    ],
    PokedexNo::PIKACHU => [
        'name' => "Pikachu",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::RAICHU => [
                'item' => ItemId::THUNDER_STONE,
            ],
        ],
    ],
    PokedexNo::RAICHU => [
        'name' => "Raichu",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::SANDSHREW => [
        'name' => "Sandshrew",
        'type' => [PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::SANDSLASH => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::SANDSLASH => [
        'name' => "Sandslash",
        'type' => [PokemonType::GROUND],
    ],
    PokedexNo::NIDORAN_F => [
        'name' => "Nidoran♀",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::NIDORINA => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::NIDORINA => [
        'name' => "Nidorina",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::NIDOQUEEN => [
                'item' => ItemId::MOON_STONE,
            ],
        ],
    ],
    PokedexNo::NIDOQUEEN => [
        'name' => "Nidoqueen",
        'type' => [PokemonType::POISON, PokemonType::GROUND],
    ],
    PokedexNo::NIDORAN_M => [
        'name' => "Nidoran♂",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::NIDORINO => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::NIDORINO => [
        'name' => "Nidorino",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::NIDOKING => [
                'item' => ItemId::MOON_STONE,
            ],
        ],
    ],
    PokedexNo::NIDOKING => [
        'name' => "Nidoking",
        'type' => [PokemonType::POISON, PokemonType::GROUND],
    ],
    PokedexNo::CLEFAIRY => [
        'name' => "Clefairy",
        'type' => [PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::CLEFABLE => [
                'item' => ItemId::MOON_STONE,
            ],
        ],
        'friendship' => 140,
    ],
    PokedexNo::CLEFABLE => [
        'name' => "Clefable",
        'type' => [PokemonType::FAIRY],
        'friendship' => 140,
    ],
    PokedexNo::VULPIX => [
        'name' => "Vulpix",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::NINETALES => [
                'item' => ItemId::FIRE_STONE,
            ],
        ],
    ],
    PokedexNo::NINETALES => [
        'name' => "Ninetales",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::JIGGLYPUFF => [
        'name' => "Jigglypuff",
        'type' => [PokemonType::NORMAL, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::WIGGLYTUFF => [
                'item' => ItemId::MOON_STONE,
            ],
        ],
    ],
    PokedexNo::WIGGLYTUFF => [
        'name' => "Wigglytuff",
        'type' => [PokemonType::NORMAL, PokemonType::FAIRY],
    ],
    PokedexNo::ZUBAT => [
        'name' => "Zubat",
        'type' => [PokemonType::POISON, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::GOLBAT => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::GOLBAT => [
        'name' => "Golbat",
        'type' => [PokemonType::POISON, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::CROBAT => [
                'friendship',
            ],
        ],
    ],
    PokedexNo::ODDISH => [
        'name' => "Oddish",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::GLOOM => [
                'level' => 21,
            ],
        ],
    ],
    PokedexNo::GLOOM => [
        'name' => "Gloom",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::VILEPLUME => [
                'item' => ItemId::LEAF_STONE,
            ],
            PokedexNo::BELLOSSOM => [
                'item' => ItemId::SUN_STONE,
            ],
        ],
    ],
    PokedexNo::VILEPLUME => [
        'name' => "Vileplume",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
    ],
    PokedexNo::PARAS => [
        'name' => "Paras",
        'type' => [PokemonType::BUG, PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::PARASECT => [
                'level' => 24,
            ],
        ],
    ],
    PokedexNo::PARASECT => [
        'name' => "Parasect",
        'type' => [PokemonType::BUG, PokemonType::GRASS],
    ],
    PokedexNo::VENONAT => [
        'name' => "Venonat",
        'type' => [PokemonType::BUG, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::VENOMOTH => [
                'level' => 31,
            ],
        ],
    ],
    PokedexNo::VENOMOTH => [
        'name' => "Venomoth",
        'type' => [PokemonType::BUG, PokemonType::POISON],
    ],
    PokedexNo::DIGLETT => [
        'name' => "Diglett",
        'type' => [PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::DUGTRIO => [
                'level' => 26,
            ],
        ],
    ],
    PokedexNo::DUGTRIO => [
        'name' => "Dugtrio",
        'type' => [PokemonType::GROUND],
    ],
    PokedexNo::MEOWTH => [
        'name' => "Meowth",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::PERSIAN => [
                'level' => 28,
            ],
        ],
    ],
    PokedexNo::PERSIAN => [
        'name' => "Persian",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::PSYDUCK => [
        'name' => "Psyduck",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::GOLDUCK => [
                'level' => 33,
            ],
        ],
    ],
    PokedexNo::GOLDUCK => [
        'name' => "Golduck",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::MANKEY => [
        'name' => "Mankey",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::PRIMEAPE => [
                'level' => 28,
            ],
        ],
    ],
    PokedexNo::PRIMEAPE => [
        'name' => "Primeape",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::ANNIHILAPE => [
                'move' => "Rage Fist",
            ],
        ],
    ],
    PokedexNo::GROWLITHE => [
        'name' => "Growlithe",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::ARCANINE => [
                'item' => ItemId::FIRE_STONE,
            ],
        ],
    ],
    PokedexNo::ARCANINE => [
        'name' => "Arcanine",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::POLIWAG => [
        'name' => "Poliwag",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::POLIWHIRL => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::POLIWHIRL => [
        'name' => "Poliwhirl",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::POLIWRATH => [
                'item' => ItemId::WATER_STONE,
            ],
            PokedexNo::POLITOED => [
                'item' => ItemId::KINGS_ROCK,
            ],
        ],
    ],
    PokedexNo::POLIWRATH => [
        'name' => "Poliwrath",
        'type' => [PokemonType::WATER, PokemonType::FIGHTING],
    ],
    PokedexNo::ABRA => [
        'name' => "Abra",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::KADABRA => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::KADABRA => [
        'name' => "Kadabra",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::ALAKAZAM => [
                'item' => ItemId::LINKING_CORD,
            ],
        ],
    ],
    PokedexNo::ALAKAZAM => [
        'name' => "Alakazam",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::MACHOP => [
        'name' => "Machop",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::MACHOKE => [
                'level' => 28,
            ],
        ],
    ],
    PokedexNo::MACHOKE => [
        'name' => "Machoke",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::MACHAMP => [
                'item' => ItemId::LINKING_CORD,
            ],
        ],
    ],
    PokedexNo::MACHAMP => [
        'name' => "Machamp",
        'type' => [PokemonType::FIGHTING],
    ],
    PokedexNo::BELLSPROUT => [
        'name' => "Bellsprout",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::WEEPINBELL => [
                'level' => 21,
            ],
        ],
    ],
    PokedexNo::WEEPINBELL => [
        'name' => "Weepinbell",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::VICTREEBEL => [
                'item' => ItemId::LEAF_STONE,
            ],
        ],
    ],
    PokedexNo::VICTREEBEL => [
        'name' => "Victreebel",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
    ],
    PokedexNo::TENTACOOL => [
        'name' => "Tentacool",
        'type' => [PokemonType::WATER, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::TENTACRUEL => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::TENTACRUEL => [
        'name' => "Tentacruel",
        'type' => [PokemonType::WATER, PokemonType::POISON],
    ],
    PokedexNo::GEODUDE => [
        'name' => "Geodude",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::GRAVELER => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::GRAVELER => [
        'name' => "Graveler",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::GOLEM => [
                'item' => ItemId::LINKING_CORD,
            ],
        ],
    ],
    PokedexNo::GOLEM => [
        'name' => "Golem",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
    ],
    PokedexNo::PONYTA => [
        'name' => "Ponyta",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::RAPIDASH => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::RAPIDASH => [
        'name' => "Rapidash",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::SLOWPOKE => [
        'name' => "Slowpoke",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::SLOWBRO => [
                'level' => 37,
            ],
            PokedexNo::SLOWKING => [
                'item' => ItemId::KINGS_ROCK,
            ],
        ],
    ],
    PokedexNo::SLOWBRO => [
        'name' => "Slowbro",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
    ],
    PokedexNo::MAGNEMITE => [
        'name' => "Magnemite",
        'type' => [PokemonType::ELECTRIC, PokemonType::STEEL],
        'evolutions' => [
            PokedexNo::MAGNETON => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::MAGNETON => [
        'name' => "Magneton",
        'type' => [PokemonType::ELECTRIC, PokemonType::STEEL],
        'evolutions' => [
            PokedexNo::MAGNEZONE => [
                'item' => ItemId::THUNDER_STONE,
            ],
        ],
    ],
    PokedexNo::FARFETCH_D => [
        'name' => "Farfetch'd",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::DODUO => [
        'name' => "Doduo",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::DODRIO => [
                'level' => 31,
            ],
        ],
    ],
    PokedexNo::DODRIO => [
        'name' => "Dodrio",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::SEEL => [
        'name' => "Seel",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::DEWGONG => [
                'level' => 34,
            ],
        ],
    ],
    PokedexNo::DEWGONG => [
        'name' => "Dewgong",
        'type' => [PokemonType::WATER, PokemonType::ICE],
    ],
    PokedexNo::GRIMER => [
        'name' => "Grimer",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::MUK => [
                'level' => 38,
            ],
        ],
    ],
    PokedexNo::MUK => [
        'name' => "Muk",
        'type' => [PokemonType::POISON],
    ],
    PokedexNo::SHELLDER => [
        'name' => "Shellder",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::CLOYSTER => [
                'item' => ItemId::WATER_STONE,
            ],
        ],
    ],
    PokedexNo::CLOYSTER => [
        'name' => "Cloyster",
        'type' => [PokemonType::WATER, PokemonType::ICE],
    ],
    PokedexNo::GASTLY => [
        'name' => "Gastly",
        'type' => [PokemonType::GHOST, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::HAUNTER => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::HAUNTER => [
        'name' => "Haunter",
        'type' => [PokemonType::GHOST, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::GENGAR => [
                'item' => ItemId::LINKING_CORD,
            ],
        ],
    ],
    PokedexNo::GENGAR => [
        'name' => "Gengar",
        'type' => [PokemonType::GHOST, PokemonType::POISON],
    ],
    PokedexNo::ONIX => [
        'name' => "Onix",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::STEELIX => [
                'item' => ItemId::METAL_COAT,
            ],
        ],
    ],
    PokedexNo::DROWZEE => [
        'name' => "Drowzee",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::HYPNO => [
                'level' => 26,
            ],
        ],
    ],
    PokedexNo::HYPNO => [
        'name' => "Hypno",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::KRABBY => [
        'name' => "Krabby",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::KINGLER => [
                'level' => 28,
            ],
        ],
    ],
    PokedexNo::KINGLER => [
        'name' => "Kingler",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::VOLTORB => [
        'name' => "Voltorb",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::ELECTRODE => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::ELECTRODE => [
        'name' => "Electrode",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::EXEGGCUTE => [
        'name' => "Exeggcute",
        'type' => [PokemonType::GRASS, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::EXEGGUTOR => [
                'item' => ItemId::LEAF_STONE,
            ],
        ],
    ],
    PokedexNo::EXEGGUTOR => [
        'name' => "Exeggutor",
        'type' => [PokemonType::GRASS, PokemonType::PSYCHIC],
    ],
    PokedexNo::CUBONE => [
        'name' => "Cubone",
        'type' => [PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::MAROWAK => [
                'level' => 28,
            ],
        ],
    ],
    PokedexNo::MAROWAK => [
        'name' => "Marowak",
        'type' => [PokemonType::GROUND],
    ],
    PokedexNo::HITMONLEE => [
        'name' => "Hitmonlee",
        'type' => [PokemonType::FIGHTING],
    ],
    PokedexNo::HITMONCHAN => [
        'name' => "Hitmonchan",
        'type' => [PokemonType::FIGHTING],
    ],
    PokedexNo::LICKITUNG => [
        'name' => "Lickitung",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::LICKILICKY => [
                'move' => "Rollout",
            ],
        ],
    ],
    PokedexNo::KOFFING => [
        'name' => "Koffing",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::WEEZING => [
                'level' => 35,
            ],
        ],
    ],
    PokedexNo::WEEZING => [
        'name' => "Weezing",
        'type' => [PokemonType::POISON],
    ],
    PokedexNo::RHYHORN => [
        'name' => "Rhyhorn",
        'type' => [PokemonType::GROUND, PokemonType::ROCK],
        'evolutions' => [
            PokedexNo::RHYDON => [
                'level' => 42,
            ],
        ],
    ],
    PokedexNo::RHYDON => [
        'name' => "Rhydon",
        'type' => [PokemonType::GROUND, PokemonType::ROCK],
        'evolutions' => [
            PokedexNo::RHYPERIOR => [
                'item' => ItemId::PROTECTOR,
            ],
        ],
    ],
    PokedexNo::CHANSEY => [
        'name' => "Chansey",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::BLISSEY => [
                'friendship',
            ],
        ],
        'friendship' => 140,
    ],
    PokedexNo::TANGELA => [
        'name' => "Tangela",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::TANGROWTH => [
                'move' => "Ancient Power",
            ],
        ],
    ],
    PokedexNo::KANGASKHAN => [
        'name' => "Kangaskhan",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::HORSEA => [
        'name' => "Horsea",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::SEADRA => [
                'level' => 32,
            ],
        ],
    ],
    PokedexNo::SEADRA => [
        'name' => "Seadra",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::KINGDRA => [
                'item' => ItemId::DRAGON_SCALE,
            ],
        ],
    ],
    PokedexNo::GOLDEEN => [
        'name' => "Goldeen",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::SEAKING => [
                'level' => 33,
            ],
        ],
    ],
    PokedexNo::SEAKING => [
        'name' => "Seaking",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::STARYU => [
        'name' => "Staryu",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::STARMIE => [
                'item' => ItemId::WATER_STONE,
            ],
        ],
    ],
    PokedexNo::STARMIE => [
        'name' => "Starmie",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
    ],
    PokedexNo::MR_MIME => [
        'name' => "Mr. Mime",
        'type' => [PokemonType::PSYCHIC, PokemonType::FAIRY],
    ],
    PokedexNo::SCYTHER => [
        'name' => "Scyther",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::SCIZOR => [
                'item' => ItemId::METAL_COAT,
            ],
            PokedexNo::KLEAVOR => [
                'item' => ItemId::BLACK_AUGURITE,
            ],
        ],
    ],
    PokedexNo::JYNX => [
        'name' => "Jynx",
        'type' => [PokemonType::ICE, PokemonType::PSYCHIC],
    ],
    PokedexNo::ELECTABUZZ => [
        'name' => "Electabuzz",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::ELECTIVIRE => [
                'item' => ItemId::ELECTIRIZER,
            ],
        ],
    ],
    PokedexNo::MAGMAR => [
        'name' => "Magmar",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::MAGMORTAR => [
                'item' => ItemId::MAGMARIZER,
            ],
        ],
    ],
    PokedexNo::PINSIR => [
        'name' => "Pinsir",
        'type' => [PokemonType::BUG],
    ],
    PokedexNo::TAUROS => [
        'name' => "Tauros",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::MAGIKARP => [
        'name' => "Magikarp",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::GYARADOS => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::GYARADOS => [
        'name' => "Gyarados",
        'type' => [PokemonType::WATER, PokemonType::FLYING],
    ],
    PokedexNo::LAPRAS => [
        'name' => "Lapras",
        'type' => [PokemonType::WATER, PokemonType::ICE],
    ],
    PokedexNo::DITTO => [
        'name' => "Ditto",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::EEVEE => [
        'name' => "Eevee",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::VAPOREON => [
                'item' => ItemId::WATER_STONE,
            ],
            PokedexNo::JOLTEON => [
                'item' => ItemId::THUNDER_STONE,
            ],
            PokedexNo::FLAREON => [
                'item' => ItemId::FIRE_STONE,
            ],
            PokedexNo::ESPEON => [
                'friendship',
                'time' => "day",
            ],
            PokedexNo::UMBREON => [
                'friendship',
                'time' => "night",
            ],
            PokedexNo::LEAFEON => [
                'item' => ItemId::LEAF_STONE,
            ],
            PokedexNo::GLACEON => [
                'item' => ItemId::ICE_STONE,
            ],
            PokedexNo::SYLVEON => [
                'friendship',
                'move' => PokemonType::FAIRY,
            ],
        ],
    ],
    PokedexNo::VAPOREON => [
        'name' => "Vaporeon",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::JOLTEON => [
        'name' => "Jolteon",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::FLAREON => [
        'name' => "Flareon",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::PORYGON => [
        'name' => "Porygon",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::PORYGON2 => [
                'item' => ItemId::UPGRADE,
            ],
        ],
    ],
    PokedexNo::OMANYTE => [
        'name' => "Omanyte",
        'type' => [PokemonType::ROCK, PokemonType::WATER],
        'evolutions' => [
            PokedexNo::OMASTAR => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::OMASTAR => [
        'name' => "Omastar",
        'type' => [PokemonType::ROCK, PokemonType::WATER],
    ],
    PokedexNo::KABUTO => [
        'name' => "Kabuto",
        'type' => [PokemonType::ROCK, PokemonType::WATER],
        'evolutions' => [
            PokedexNo::KABUTOPS => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::KABUTOPS => [
        'name' => "Kabutops",
        'type' => [PokemonType::ROCK, PokemonType::WATER],
    ],
    PokedexNo::AERODACTYL => [
        'name' => "Aerodactyl",
        'type' => [PokemonType::ROCK, PokemonType::FLYING],
    ],
    PokedexNo::SNORLAX => [
        'name' => "Snorlax",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::ARTICUNO => [
        'name' => "Articuno",
        'type' => [PokemonType::ICE, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::ZAPDOS => [
        'name' => "Zapdos",
        'type' => [PokemonType::ELECTRIC, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::MOLTRES => [
        'name' => "Moltres",
        'type' => [PokemonType::FIRE, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::DRATINI => [
        'name' => "Dratini",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::DRAGONAIR => [
                'level' => 30,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::DRAGONAIR => [
        'name' => "Dragonair",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::DRAGONITE => [
                'level' => 55,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::DRAGONITE => [
        'name' => "Dragonite",
        'type' => [PokemonType::DRAGON, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::MEWTWO => [
        'name' => "Mewtwo",
        'type' => [PokemonType::PSYCHIC],
        'friendship' => 0,
    ],
    PokedexNo::MEW => [
        'name' => "Mew",
        'type' => [PokemonType::PSYCHIC],
        'friendship' => 100,
    ],
    PokedexNo::CHIKORITA => [
        'name' => "Chikorita",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::BAYLEEF => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::BAYLEEF => [
        'name' => "Bayleef",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::MEGANIUM => [
                'level' => 32,
            ],
        ],
    ],
    PokedexNo::MEGANIUM => [
        'name' => "Meganium",
        'type' => [PokemonType::GRASS],
    ],
    PokedexNo::CYNDAQUIL => [
        'name' => "Cyndaquil",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::QUILAVA => [
                'level' => 14,
            ],
        ],
    ],
    PokedexNo::QUILAVA => [
        'name' => "Quilava",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::TYPHLOSION => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::TYPHLOSION => [
        'name' => "Typhlosion",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::TOTODILE => [
        'name' => "Totodile",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::CROCONAW => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::CROCONAW => [
        'name' => "Croconaw",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::FERALIGATR => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::FERALIGATR => [
        'name' => "Feraligatr",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::SENTRET => [
        'name' => "Sentret",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::FURRET => [
                'level' => 15,
            ],
        ],
    ],
    PokedexNo::FURRET => [
        'name' => "Furret",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::HOOTHOOT => [
        'name' => "Hoothoot",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::NOCTOWL => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::NOCTOWL => [
        'name' => "Noctowl",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::LEDYBA => [
        'name' => "Ledyba",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::LEDIAN => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::LEDIAN => [
        'name' => "Ledian",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::SPINARAK => [
        'name' => "Spinarak",
        'type' => [PokemonType::BUG, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::ARIADOS => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::ARIADOS => [
        'name' => "Ariados",
        'type' => [PokemonType::BUG, PokemonType::POISON],
    ],
    PokedexNo::CROBAT => [
        'name' => "Crobat",
        'type' => [PokemonType::POISON, PokemonType::FLYING],
    ],
    PokedexNo::CHINCHOU => [
        'name' => "Chinchou",
        'type' => [PokemonType::WATER, PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::LANTURN => [
                'level' => 27,
            ],
        ],
    ],
    PokedexNo::LANTURN => [
        'name' => "Lanturn",
        'type' => [PokemonType::WATER, PokemonType::ELECTRIC],
    ],
    PokedexNo::PICHU => [
        'name' => "Pichu",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::PIKACHU => [
                'friendship',
            ],
        ],
    ],
    PokedexNo::CLEFFA => [
        'name' => "Cleffa",
        'type' => [PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::CLEFAIRY => [
                'friendship',
            ],
        ],
        'friendship' => 140,
    ],
    PokedexNo::IGGLYBUFF => [
        'name' => "Igglybuff",
        'type' => [PokemonType::NORMAL, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::JIGGLYPUFF => [
                'friendship',
            ],
        ],
    ],
    PokedexNo::TOGEPI => [
        'name' => "Togepi",
        'type' => [PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::TOGETIC => [
                'friendship',
            ],
        ],
    ],
    PokedexNo::TOGETIC => [
        'name' => "Togetic",
        'type' => [PokemonType::FAIRY, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::TOGEKISS => [
                'item' => ItemId::SHINY_STONE,
            ],
        ],
    ],
    PokedexNo::NATU => [
        'name' => "Natu",
        'type' => [PokemonType::PSYCHIC, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::XATU => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::XATU => [
        'name' => "Xatu",
        'type' => [PokemonType::PSYCHIC, PokemonType::FLYING],
    ],
    PokedexNo::MAREEP => [
        'name' => "Mareep",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::FLAAFFY => [
                'level' => 15,
            ],
        ],
    ],
    PokedexNo::FLAAFFY => [
        'name' => "Flaaffy",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::AMPHAROS => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::AMPHAROS => [
        'name' => "Ampharos",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::BELLOSSOM => [
        'name' => "Bellossom",
        'type' => [PokemonType::GRASS],
    ],
    PokedexNo::MARILL => [
        'name' => "Marill",
        'type' => [PokemonType::WATER, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::AZUMARILL => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::AZUMARILL => [
        'name' => "Azumarill",
        'type' => [PokemonType::WATER, PokemonType::FAIRY],
    ],
    PokedexNo::SUDOWOODO => [
        'name' => "Sudowoodo",
        'type' => [PokemonType::ROCK],
    ],
    PokedexNo::POLITOED => [
        'name' => "Politoed",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::HOPPIP => [
        'name' => "Hoppip",
        'type' => [PokemonType::GRASS, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::SKIPLOOM => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::SKIPLOOM => [
        'name' => "Skiploom",
        'type' => [PokemonType::GRASS, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::JUMPLUFF => [
                'level' => 27,
            ],
        ],
    ],
    PokedexNo::JUMPLUFF => [
        'name' => "Jumpluff",
        'type' => [PokemonType::GRASS, PokemonType::FLYING],
    ],
    PokedexNo::AIPOM => [
        'name' => "Aipom",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::AMBIPOM => [
                'move' => "Double Hit",
            ],
        ],
    ],
    PokedexNo::SUNKERN => [
        'name' => "Sunkern",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::SUNFLORA => [
                'item' => ItemId::SUN_STONE,
            ],
        ],
    ],
    PokedexNo::SUNFLORA => [
        'name' => "Sunflora",
        'type' => [PokemonType::GRASS],
    ],
    PokedexNo::YANMA => [
        'name' => "Yanma",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::YANMEGA => [
                'move' => "Ancient Power",
            ],
        ],
    ],
    PokedexNo::WOOPER => [
        'name' => "Wooper",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::QUAGSIRE => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::QUAGSIRE => [
        'name' => "Quagsire",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
    ],
    PokedexNo::ESPEON => [
        'name' => "Espeon",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::UMBREON => [
        'name' => "Umbreon",
        'type' => [PokemonType::DARK],
        'friendship' => 35,
    ],
    PokedexNo::MURKROW => [
        'name' => "Murkrow",
        'type' => [PokemonType::DARK, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::HONCHKROW => [
                'item' => ItemId::DUSK_STONE,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::SLOWKING => [
        'name' => "Slowking",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
    ],
    PokedexNo::MISDREAVUS => [
        'name' => "Misdreavus",
        'type' => [PokemonType::GHOST],
        'evolutions' => [
            PokedexNo::MISMAGIUS => [
                'item' => ItemId::DUSK_STONE,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::UNOWN => [
        'name' => "Unown",
        'type' => [PokemonType::PSYCHIC],
        'forms' => [
            "A",
            "B",
            "C",
            "D",
            "E",
            "F",
            "G",
            "H",
            "I",
            "J",
            "K",
            "L",
            "M",
            "N",
            "O",
            "P",
            "Q",
            "R",
            "S",
            "T",
            "U",
            "V",
            "W",
            "X",
            "Y",
            "Z",
            "!",
            "?",
        ],
    ],
    PokedexNo::WOBBUFFET => [
        'name' => "Wobbuffet",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::GIRAFARIG => [
        'name' => "Girafarig",
        'type' => [PokemonType::NORMAL, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::FARIGIRAF => [
                'move' => "Twin Beam",
            ],
        ],
    ],
    PokedexNo::PINECO => [
        'name' => "Pineco",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::FORRETRESS => [
                'level' => 31,
            ],
        ],
    ],
    PokedexNo::FORRETRESS => [
        'name' => "Forretress",
        'type' => [PokemonType::BUG, PokemonType::STEEL],
    ],
    PokedexNo::DUNSPARCE => [
        'name' => "Dunsparce",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::DUDUNSPARCE => [
                'move' => "Hyper Drill",
            ],
        ],
    ],
    PokedexNo::GLIGAR => [
        'name' => "Gligar",
        'type' => [PokemonType::GROUND, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::GLISCOR => [
                'holding' => ItemId::RAZOR_FANG,
                'time' => "night",
            ],
        ],
    ],
    PokedexNo::STEELIX => [
        'name' => "Steelix",
        'type' => [PokemonType::STEEL, PokemonType::GROUND],
    ],
    PokedexNo::SNUBBULL => [
        'name' => "Snubbull",
        'type' => [PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::GRANBULL => [
                'level' => 23,
            ],
        ],
    ],
    PokedexNo::GRANBULL => [
        'name' => "Granbull",
        'type' => [PokemonType::FAIRY],
    ],
    PokedexNo::QWILFISH => [
        'name' => "Qwilfish",
        'type' => [PokemonType::WATER, PokemonType::POISON],
    ],
    PokedexNo::SCIZOR => [
        'name' => "Scizor",
        'type' => [PokemonType::BUG, PokemonType::STEEL],
    ],
    PokedexNo::SHUCKLE => [
        'name' => "Shuckle",
        'type' => [PokemonType::BUG, PokemonType::ROCK],
    ],
    PokedexNo::HERACROSS => [
        'name' => "Heracross",
        'type' => [PokemonType::BUG, PokemonType::FIGHTING],
    ],
    PokedexNo::SNEASEL => [
        'name' => "Sneasel",
        'type' => [PokemonType::DARK, PokemonType::ICE],
        'evolutions' => [
            PokedexNo::WEAVILE => [
                'holding' => ItemId::RAZOR_CLAW,
                'time' => "night",
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::TEDDIURSA => [
        'name' => "Teddiursa",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::URSARING => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::URSARING => [
        'name' => "Ursaring",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::URSALUNA => [
                'item' => ItemId::PEAT_BLOCK,
                'time' => "Full Moon",
            ],
        ],
    ],
    PokedexNo::SLUGMA => [
        'name' => "Slugma",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::MAGCARGO => [
                'level' => 38,
            ],
        ],
    ],
    PokedexNo::MAGCARGO => [
        'name' => "Magcargo",
        'type' => [PokemonType::FIRE, PokemonType::ROCK],
    ],
    PokedexNo::SWINUB => [
        'name' => "Swinub",
        'type' => [PokemonType::ICE, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::PILOSWINE => [
                'level' => 33,
            ],
        ],
    ],
    PokedexNo::PILOSWINE => [
        'name' => "Piloswine",
        'type' => [PokemonType::ICE, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::MAMOSWINE => [
                'move' => "Ancient Power",
            ],
        ],
    ],
    PokedexNo::CORSOLA => [
        'name' => "Corsola",
        'type' => [PokemonType::WATER, PokemonType::ROCK],
    ],
    PokedexNo::REMORAID => [
        'name' => "Remoraid",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::OCTILLERY => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::OCTILLERY => [
        'name' => "Octillery",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::DELIBIRD => [
        'name' => "Delibird",
        'type' => [PokemonType::ICE, PokemonType::FLYING],
    ],
    PokedexNo::MANTINE => [
        'name' => "Mantine",
        'type' => [PokemonType::WATER, PokemonType::FLYING],
    ],
    PokedexNo::SKARMORY => [
        'name' => "Skarmory",
        'type' => [PokemonType::STEEL, PokemonType::FLYING],
    ],
    PokedexNo::HOUNDOUR => [
        'name' => "Houndour",
        'type' => [PokemonType::DARK, PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::HOUNDOOM => [
                'level' => 24,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::HOUNDOOM => [
        'name' => "Houndoom",
        'type' => [PokemonType::DARK, PokemonType::FIRE],
        'friendship' => 35,
    ],
    PokedexNo::KINGDRA => [
        'name' => "Kingdra",
        'type' => [PokemonType::WATER, PokemonType::DRAGON],
    ],
    PokedexNo::PHANPY => [
        'name' => "Phanpy",
        'type' => [PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::DONPHAN => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::DONPHAN => [
        'name' => "Donphan",
        'type' => [PokemonType::GROUND],
    ],
    PokedexNo::PORYGON2 => [
        'name' => "Porygon2",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::PORYGON_Z => [
                'item' => ItemId::DUBIOUS_DISC,
            ],
        ],
    ],
    PokedexNo::STANTLER => [
        'name' => "Stantler",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::WYRDEER => [
                'move' => "Psyshield Bash",
            ],
        ],
    ],
    PokedexNo::SMEARGLE => [
        'name' => "Smeargle",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::TYROGUE => [
        'name' => "Tyrogue",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::HITMONLEE => [
                'level' => 20,
                'stats' => "Physical Attack > Physical Defence",
            ],
            PokedexNo::HITMONCHAN => [
                'level' => 20,
                'stats' => "Physical Attack < Physical Defence",
            ],
            PokedexNo::HITMONTOP => [
                'level' => 20,
                'stats' => "Physical Attack = Physical Defence",
            ],
        ],
    ],
    PokedexNo::HITMONTOP => [
        'name' => "Hitmontop",
        'type' => [PokemonType::FIGHTING],
    ],
    PokedexNo::SMOOCHUM => [
        'name' => "Smoochum",
        'type' => [PokemonType::ICE, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::JYNX => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::ELEKID => [
        'name' => "Elekid",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::ELECTABUZZ => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::MAGBY => [
        'name' => "Magby",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::MAGMAR => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::MILTANK => [
        'name' => "Miltank",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::BLISSEY => [
        'name' => "Blissey",
        'type' => [PokemonType::NORMAL],
        'friendship' => 140,
    ],
    PokedexNo::RAIKOU => [
        'name' => "Raikou",
        'type' => [PokemonType::ELECTRIC],
        'friendship' => 35,
    ],
    PokedexNo::ENTEI => [
        'name' => "Entei",
        'type' => [PokemonType::FIRE],
        'friendship' => 35,
    ],
    PokedexNo::SUICUNE => [
        'name' => "Suicune",
        'type' => [PokemonType::WATER],
        'friendship' => 35,
    ],
    PokedexNo::LARVITAR => [
        'name' => "Larvitar",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::PUPITAR => [
                'level' => 30,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::PUPITAR => [
        'name' => "Pupitar",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::TYRANITAR => [
                'level' => 55,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::TYRANITAR => [
        'name' => "Tyranitar",
        'type' => [PokemonType::ROCK, PokemonType::DARK],
        'friendship' => 35,
    ],
    PokedexNo::LUGIA => [
        'name' => "Lugia",
        'type' => [PokemonType::PSYCHIC, PokemonType::FLYING],
        'friendship' => 0,
    ],
    PokedexNo::HO_OH => [
        'name' => "Ho-Oh",
        'type' => [PokemonType::FIRE, PokemonType::FLYING],
        'friendship' => 0,
    ],
    PokedexNo::CELEBI => [
        'name' => "Celebi",
        'type' => [PokemonType::PSYCHIC, PokemonType::GRASS],
        'friendship' => 100,
    ],
    PokedexNo::TREECKO => [
        'name' => "Treecko",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::GROVYLE => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::GROVYLE => [
        'name' => "Grovyle",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::SCEPTILE => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::SCEPTILE => [
        'name' => "Sceptile",
        'type' => [PokemonType::GRASS],
    ],
    PokedexNo::TORCHIC => [
        'name' => "Torchic",
        'type' => [PokemonType::FIRE],
        'evolutions' => [
            PokedexNo::COMBUSKEN => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::COMBUSKEN => [
        'name' => "Combusken",
        'type' => [PokemonType::FIRE, PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::BLAZIKEN => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::BLAZIKEN => [
        'name' => "Blaziken",
        'type' => [PokemonType::FIRE, PokemonType::FIGHTING],
    ],
    PokedexNo::MUDKIP => [
        'name' => "Mudkip",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::MARSHTOMP => [
                'level' => 16,
            ],
        ],
    ],
    PokedexNo::MARSHTOMP => [
        'name' => "Marshtomp",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::SWAMPERT => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::SWAMPERT => [
        'name' => "Swampert",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
    ],
    PokedexNo::POOCHYENA => [
        'name' => "Poochyena",
        'type' => [PokemonType::DARK],
        'evolutions' => [
            PokedexNo::MIGHTYENA => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::MIGHTYENA => [
        'name' => "Mightyena",
        'type' => [PokemonType::DARK],
    ],
    PokedexNo::ZIGZAGOON => [
        'name' => "Zigzagoon",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::LINOONE => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::LINOONE => [
        'name' => "Linoone",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::WURMPLE => [
        'name' => "Wurmple",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::SILCOON => [
                'level' => 7,
                'randomly',
            ],
            PokedexNo::CASCOON => [
                'level' => 7,
                'randomly',
            ],
        ],
    ],
    PokedexNo::SILCOON => [
        'name' => "Silcoon",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::BEAUTIFLY => [
                'level' => 10,
            ],
        ],
    ],
    PokedexNo::BEAUTIFLY => [
        'name' => "Beautifly",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::CASCOON => [
        'name' => "Cascoon",
        'type' => [PokemonType::BUG],
        'evolutions' => [
            PokedexNo::DUSTOX => [
                'level' => 10,
            ],
        ],
    ],
    PokedexNo::DUSTOX => [
        'name' => "Dustox",
        'type' => [PokemonType::BUG, PokemonType::POISON],
    ],
    PokedexNo::LOTAD => [
        'name' => "Lotad",
        'type' => [PokemonType::WATER, PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::LOMBRE => [
                'level' => 14,
            ],
        ],
    ],
    PokedexNo::LOMBRE => [
        'name' => "Lombre",
        'type' => [PokemonType::WATER, PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::LUDICOLO => [
                'item' => ItemId::WATER_STONE,
            ],
        ],
    ],
    PokedexNo::LUDICOLO => [
        'name' => "Ludicolo",
        'type' => [PokemonType::WATER, PokemonType::GRASS],
    ],
    PokedexNo::SEEDOT => [
        'name' => "Seedot",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::NUZLEAF => [
                'level' => 14,
            ],
        ],
    ],
    PokedexNo::NUZLEAF => [
        'name' => "Nuzleaf",
        'type' => [PokemonType::GRASS, PokemonType::DARK],
        'evolutions' => [
            PokedexNo::SHIFTRY => [
                'item' => ItemId::LEAF_STONE,
            ],
        ],
    ],
    PokedexNo::SHIFTRY => [
        'name' => "Shiftry",
        'type' => [PokemonType::GRASS, PokemonType::DARK],
    ],
    PokedexNo::TAILLOW => [
        'name' => "Taillow",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::SWELLOW => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::SWELLOW => [
        'name' => "Swellow",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
    ],
    PokedexNo::WINGULL => [
        'name' => "Wingull",
        'type' => [PokemonType::WATER, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::PELIPPER => [
                'level' => 25,
            ],
        ],
    ],
    PokedexNo::PELIPPER => [
        'name' => "Pelipper",
        'type' => [PokemonType::WATER, PokemonType::FLYING],
    ],
    PokedexNo::RALTS => [
        'name' => "Ralts",
        'type' => [PokemonType::PSYCHIC, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::KIRLIA => [
                'level' => 20,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::KIRLIA => [
        'name' => "Kirlia",
        'type' => [PokemonType::PSYCHIC, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::GARDEVOIR => [
                'level' => 30,
            ],
            PokedexNo::GALLADE => [
                'item' => ItemId::DAWN_STONE,
                'sex' => Sex::MALE,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::GARDEVOIR => [
        'name' => "Gardevoir",
        'type' => [PokemonType::PSYCHIC, PokemonType::FAIRY],
        'friendship' => 35,
    ],
    PokedexNo::SURSKIT => [
        'name' => "Surskit",
        'type' => [PokemonType::BUG, PokemonType::WATER],
        'evolutions' => [
            PokedexNo::MASQUERAIN => [
                'level' => 22,
            ],
        ],
    ],
    PokedexNo::MASQUERAIN => [
        'name' => "Masquerain",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::SHROOMISH => [
        'name' => "Shroomish",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::BRELOOM => [
                'level' => 23,
            ],
        ],
    ],
    PokedexNo::BRELOOM => [
        'name' => "Breloom",
        'type' => [PokemonType::GRASS, PokemonType::FIGHTING],
    ],
    PokedexNo::SLAKOTH => [
        'name' => "Slakoth",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::VIGOROTH => [
                'level' => 18,
            ],
        ],
    ],
    PokedexNo::VIGOROTH => [
        'name' => "Vigoroth",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::SLAKING => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::SLAKING => [
        'name' => "Slaking",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::NINCADA => [
        'name' => "Nincada",
        'type' => [PokemonType::BUG, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::NINJASK => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::NINJASK => [
        'name' => "Ninjask",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::SHEDINJA => [
        'name' => "Shedinja",
        'type' => [PokemonType::BUG, PokemonType::GHOST],
    ],
    PokedexNo::WHISMUR => [
        'name' => "Whismur",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::LOUDRED => [
                'level' => 20,
            ],
        ],
    ],
    PokedexNo::LOUDRED => [
        'name' => "Loudred",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::EXPLOUD => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::EXPLOUD => [
        'name' => "Exploud",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::MAKUHITA => [
        'name' => "Makuhita",
        'type' => [PokemonType::FIGHTING],
        'evolutions' => [
            PokedexNo::HARIYAMA => [
                'level' => 24,
            ],
        ],
    ],
    PokedexNo::HARIYAMA => [
        'name' => "Hariyama",
        'type' => [PokemonType::FIGHTING],
    ],
    PokedexNo::AZURILL => [
        'name' => "Azurill",
        'type' => [PokemonType::NORMAL, PokemonType::FAIRY],
        'evolutions' => [
            PokedexNo::MARILL => [
                'friendship',
            ],
        ],
    ],
    PokedexNo::NOSEPASS => [
        'name' => "Nosepass",
        'type' => [PokemonType::ROCK],
        'evolutions' => [
            PokedexNo::PROBOPASS => [
                'item' => ItemId::THUNDER_STONE,
            ],
        ],
    ],
    PokedexNo::SKITTY => [
        'name' => "Skitty",
        'type' => [PokemonType::NORMAL],
        'evolutions' => [
            PokedexNo::DELCATTY => [
                'item' => ItemId::MOON_STONE,
            ],
        ],
    ],
    PokedexNo::DELCATTY => [
        'name' => "Delcatty",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::SABLEYE => [
        'name' => "Sableye",
        'type' => [PokemonType::DARK, PokemonType::GHOST],
        'friendship' => 35,
    ],
    PokedexNo::MAWILE => [
        'name' => "Mawile",
        'type' => [PokemonType::STEEL, PokemonType::FAIRY],
    ],
    PokedexNo::ARON => [
        'name' => "Aron",
        'type' => [PokemonType::STEEL, PokemonType::ROCK],
        'evolutions' => [
            PokedexNo::LAIRON => [
                'level' => 32,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::LAIRON => [
        'name' => "Lairon",
        'type' => [PokemonType::STEEL, PokemonType::ROCK],
        'evolutions' => [
            PokedexNo::AGGRON => [
                'level' => 42,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::AGGRON => [
        'name' => "Aggron",
        'type' => [PokemonType::STEEL, PokemonType::ROCK],
        'friendship' => 35,
    ],
    PokedexNo::MEDITITE => [
        'name' => "Meditite",
        'type' => [PokemonType::FIGHTING, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::MEDICHAM => [
                'level' => 37,
            ],
        ],
    ],
    PokedexNo::MEDICHAM => [
        'name' => "Medicham",
        'type' => [PokemonType::FIGHTING, PokemonType::PSYCHIC],
    ],
    PokedexNo::ELECTRIKE => [
        'name' => "Electrike",
        'type' => [PokemonType::ELECTRIC],
        'evolutions' => [
            PokedexNo::MANECTRIC => [
                'level' => 26,
            ],
        ],
    ],
    PokedexNo::MANECTRIC => [
        'name' => "Manectric",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::PLUSLE => [
        'name' => "Plusle",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::MINUN => [
        'name' => "Minun",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::VOLBEAT => [
        'name' => "Volbeat",
        'type' => [PokemonType::BUG],
    ],
    PokedexNo::ILLUMISE => [
        'name' => "Illumise",
        'type' => [PokemonType::BUG],
    ],
    PokedexNo::ROSELIA => [
        'name' => "Roselia",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::ROSERADE => [
                'item' => ItemId::SHINY_STONE,
            ],
        ],
    ],
    PokedexNo::GULPIN => [
        'name' => "Gulpin",
        'type' => [PokemonType::POISON],
        'evolutions' => [
            PokedexNo::SWALOT => [
                'level' => 26,
            ],
        ],
    ],
    PokedexNo::SWALOT => [
        'name' => "Swalot",
        'type' => [PokemonType::POISON],
    ],
    PokedexNo::CARVANHA => [
        'name' => "Carvanha",
        'type' => [PokemonType::WATER, PokemonType::DARK],
        'evolutions' => [
            PokedexNo::SHARPEDO => [
                'level' => 30,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::SHARPEDO => [
        'name' => "Sharpedo",
        'type' => [PokemonType::WATER, PokemonType::DARK],
        'friendship' => 35,
    ],
    PokedexNo::WAILMER => [
        'name' => "Wailmer",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::WAILORD => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::WAILORD => [
        'name' => "Wailord",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::NUMEL => [
        'name' => "Numel",
        'type' => [PokemonType::FIRE, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::CAMERUPT => [
                'level' => 33,
            ],
        ],
    ],
    PokedexNo::CAMERUPT => [
        'name' => "Camerupt",
        'type' => [PokemonType::FIRE, PokemonType::GROUND],
    ],
    PokedexNo::TORKOAL => [
        'name' => "Torkoal",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::SPOINK => [
        'name' => "Spoink",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::GRUMPIG => [
                'level' => 32,
            ],
        ],
    ],
    PokedexNo::GRUMPIG => [
        'name' => "Grumpig",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::SPINDA => [
        'name' => "Spinda",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::TRAPINCH => [
        'name' => "Trapinch",
        'type' => [PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::VIBRAVA => [
                'level' => 35,
            ],
        ],
    ],
    PokedexNo::VIBRAVA => [
        'name' => "Vibrava",
        'type' => [PokemonType::GROUND, PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::FLYGON => [
                'level' => 45,
            ],
        ],
    ],
    PokedexNo::FLYGON => [
        'name' => "Flygon",
        'type' => [PokemonType::GROUND, PokemonType::DRAGON],
    ],
    PokedexNo::CACNEA => [
        'name' => "Cacnea",
        'type' => [PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::CACTURNE => [
                'level' => 32,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::CACTURNE => [
        'name' => "Cacturne",
        'type' => [PokemonType::GRASS, PokemonType::DARK],
        'friendship' => 35,
    ],
    PokedexNo::SWABLU => [
        'name' => "Swablu",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'evolutions' => [
            PokedexNo::ALTARIA => [
                'level' => 35,
            ],
        ],
    ],
    PokedexNo::ALTARIA => [
        'name' => "Altaria",
        'type' => [PokemonType::DRAGON, PokemonType::FLYING],
    ],
    PokedexNo::ZANGOOSE => [
        'name' => "Zangoose",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::SEVIPER => [
        'name' => "Seviper",
        'type' => [PokemonType::POISON],
    ],
    PokedexNo::LUNATONE => [
        'name' => "Lunatone",
        'type' => [PokemonType::ROCK, PokemonType::PSYCHIC],
    ],
    PokedexNo::SOLROCK => [
        'name' => "Solrock",
        'type' => [PokemonType::ROCK, PokemonType::PSYCHIC],
    ],
    PokedexNo::BARBOACH => [
        'name' => "Barboach",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
        'evolutions' => [
            PokedexNo::WHISCASH => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::WHISCASH => [
        'name' => "Whiscash",
        'type' => [PokemonType::WATER, PokemonType::GROUND],
    ],
    PokedexNo::CORPHISH => [
        'name' => "Corphish",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::CRAWDAUNT => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::CRAWDAUNT => [
        'name' => "Crawdaunt",
        'type' => [PokemonType::WATER, PokemonType::DARK],
    ],
    PokedexNo::BALTOY => [
        'name' => "Baltoy",
        'type' => [PokemonType::GROUND, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::CLAYDOL => [
                'level' => 36,
            ],
        ],
    ],
    PokedexNo::CLAYDOL => [
        'name' => "Claydol",
        'type' => [PokemonType::GROUND, PokemonType::PSYCHIC],
    ],
    PokedexNo::LILEEP => [
        'name' => "Lileep",
        'type' => [PokemonType::ROCK, PokemonType::GRASS],
        'evolutions' => [
            PokedexNo::CRADILY => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::CRADILY => [
        'name' => "Cradily",
        'type' => [PokemonType::ROCK, PokemonType::GRASS],
    ],
    PokedexNo::ANORITH => [
        'name' => "Anorith",
        'type' => [PokemonType::ROCK, PokemonType::BUG],
        'evolutions' => [
            PokedexNo::ARMALDO => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::ARMALDO => [
        'name' => "Armaldo",
        'type' => [PokemonType::ROCK, PokemonType::BUG],
    ],
    PokedexNo::FEEBAS => [
        'name' => "Feebas",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::MILOTIC => [
                'item' => ItemId::PRISM_SCALE,
            ],
        ],
    ],
    PokedexNo::MILOTIC => [
        'name' => "Milotic",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::CASTFORM => [
        'name' => "Castform",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::KECLEON => [
        'name' => "Kecleon",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::SHUPPET => [
        'name' => "Shuppet",
        'type' => [PokemonType::GHOST],
        'evolutions' => [
            PokedexNo::BANETTE => [
                'level' => 37,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::BANETTE => [
        'name' => "Banette",
        'type' => [PokemonType::GHOST],
        'friendship' => 35,
    ],
    PokedexNo::DUSKULL => [
        'name' => "Duskull",
        'type' => [PokemonType::GHOST],
        'evolutions' => [
            PokedexNo::DUSCLOPS => [
                'level' => 37,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::DUSCLOPS => [
        'name' => "Dusclops",
        'type' => [PokemonType::GHOST],
        'evolutions' => [
            PokedexNo::DUSKNOIR => [
                'item' => ItemId::REAPER_CLOTH,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::TROPIUS => [
        'name' => "Tropius",
        'type' => [PokemonType::GRASS, PokemonType::FLYING],
    ],
    PokedexNo::CHIMECHO => [
        'name' => "Chimecho",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::ABSOL => [
        'name' => "Absol",
        'type' => [PokemonType::DARK],
        'friendship' => 35,
    ],
    PokedexNo::WYNAUT => [
        'name' => "Wynaut",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::WOBBUFFET => [
                'level' => 15,
            ],
        ],
    ],
    PokedexNo::SNORUNT => [
        'name' => "Snorunt",
        'type' => [PokemonType::ICE],
        'evolutions' => [
            PokedexNo::GLALIE => [
                'level' => 42,
            ],
            PokedexNo::FROSLASS => [
                'item' => ItemId::DAWN_STONE,
                'sex' => Sex::FEMALE,
            ],
        ],
    ],
    PokedexNo::GLALIE => [
        'name' => "Glalie",
        'type' => [PokemonType::ICE],
    ],
    PokedexNo::SPHEAL => [
        'name' => "Spheal",
        'type' => [PokemonType::ICE, PokemonType::WATER],
        'evolutions' => [
            PokedexNo::SEALEO => [
                'level' => 32,
            ],
        ],
    ],
    PokedexNo::SEALEO => [
        'name' => "Sealeo",
        'type' => [PokemonType::ICE, PokemonType::WATER],
        'evolutions' => [
            PokedexNo::WALREIN => [
                'level' => 44,
            ],
        ],
    ],
    PokedexNo::WALREIN => [
        'name' => "Walrein",
        'type' => [PokemonType::ICE, PokemonType::WATER],
    ],
    PokedexNo::CLAMPERL => [
        'name' => "Clamperl",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::HUNTAIL => [
                'item' => ItemId::DEEP_SEA_TOOTH,
            ],
            PokedexNo::GOREBYSS => [
                'item' => ItemId::DEEP_SEA_SCALE,
            ],
        ],
    ],
    PokedexNo::HUNTAIL => [
        'name' => "Huntail",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::GOREBYSS => [
        'name' => "Gorebyss",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::RELICANTH => [
        'name' => "Relicanth",
        'type' => [PokemonType::WATER, PokemonType::ROCK],
    ],
    PokedexNo::LUVDISC => [
        'name' => "Luvdisc",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::BAGON => [
        'name' => "Bagon",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::SHELGON => [
                'level' => 30,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::SHELGON => [
        'name' => "Shelgon",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::SALAMENCE => [
                'level' => 50,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::SALAMENCE => [
        'name' => "Salamence",
        'type' => [PokemonType::DRAGON, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::BELDUM => [
        'name' => "Beldum",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::METANG => [
                'level' => 20,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::METANG => [
        'name' => "Metang",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::METAGROSS => [
                'level' => 45,
            ],
        ],
        'friendship' => 35,
    ],
    PokedexNo::METAGROSS => [
        'name' => "Metagross",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
        'friendship' => 35,
    ],
    PokedexNo::REGIROCK => [
        'name' => "Regirock",
        'type' => [PokemonType::ROCK],
        'friendship' => 35,
    ],
    PokedexNo::REGICE => [
        'name' => "Regice",
        'type' => [PokemonType::ICE],
        'friendship' => 35,
    ],
    PokedexNo::REGISTEEL => [
        'name' => "Registeel",
        'type' => [PokemonType::STEEL],
        'friendship' => 35,
    ],
    PokedexNo::LATIAS => [
        'name' => "Latias",
        'type' => [PokemonType::DRAGON, PokemonType::PSYCHIC],
        'friendship' => 90,
    ],
    PokedexNo::LATIOS => [
        'name' => "Latios",
        'type' => [PokemonType::DRAGON, PokemonType::PSYCHIC],
        'friendship' => 90,
    ],
    PokedexNo::KYOGRE => [
        'name' => "Kyogre",
        'type' => [PokemonType::WATER],
        'friendship' => 0,
    ],
    PokedexNo::GROUDON => [
        'name' => "Groudon",
        'type' => [PokemonType::GROUND],
        'friendship' => 0,
    ],
    PokedexNo::RAYQUAZA => [
        'name' => "Rayquaza",
        'type' => [PokemonType::DRAGON, PokemonType::FLYING],
        'friendship' => 0,
    ],
    PokedexNo::JIRACHI => [
        'name' => "Jirachi",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
        'friendship' => 100,
    ],
    PokedexNo::DEOXYS => [
        'name' => "Deoxys",
        'type' => [PokemonType::PSYCHIC],
        'friendship' => 0,
    ],
    PokedexNo::ROSERADE => [
        'name' => "Roserade",
        'type' => [PokemonType::GRASS, PokemonType::POISON],
    ],
    PokedexNo::AMBIPOM => [
        'name' => "Ambipom",
        'type' => [PokemonType::NORMAL],
        'friendship' => 100,
    ],
    PokedexNo::MISMAGIUS => [
        'name' => "Mismagius",
        'type' => [PokemonType::GHOST],
        'friendship' => 35,
    ],
    PokedexNo::HONCHKROW => [
        'name' => "Honchkrow",
        'type' => [PokemonType::DARK, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::CHINGLING => [
        'name' => "Chingling",
        'type' => [PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::CHIMECHO => [
                'friendship',
                'time' => "night",
            ],
        ],
    ],
    PokedexNo::SKUNTANK => [
        'name' => "Skuntank",
        'type' => [PokemonType::POISON, PokemonType::DARK],
    ],
    PokedexNo::BRONZOR => [
        'name' => "Bronzor",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::BRONZONG => [
                'level' => 33,
            ],
        ],
    ],
    PokedexNo::BRONZONG => [
        'name' => "Bronzong",
        'type' => [PokemonType::STEEL, PokemonType::PSYCHIC],
    ],
    PokedexNo::CHATOT => [
        'name' => "Chatot",
        'type' => [PokemonType::NORMAL, PokemonType::FLYING],
        'friendship' => 35,
    ],
    PokedexNo::SPIRITOMB => [
        'name' => "Spiritomb",
        'type' => [PokemonType::GHOST, PokemonType::DARK],
    ],
    PokedexNo::GARCHOMP => [
        'name' => "Garchomp",
        'type' => [PokemonType::DRAGON, PokemonType::GROUND],
    ],
    PokedexNo::LUCARIO => [
        'name' => "Lucario",
        'type' => [PokemonType::FIGHTING, PokemonType::STEEL],
    ],
    PokedexNo::TOXICROAK => [
        'name' => "Toxicroak",
        'type' => [PokemonType::POISON, PokemonType::FIGHTING],
    ],
    PokedexNo::WEAVILE => [
        'name' => "Weavile",
        'type' => [PokemonType::DARK, PokemonType::ICE],
        'friendship' => 35,
    ],
    PokedexNo::MAGNEZONE => [
        'name' => "Magnezone",
        'type' => [PokemonType::ELECTRIC, PokemonType::STEEL],
    ],
    PokedexNo::LICKILICKY => [
        'name' => "Lickilicky",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::RHYPERIOR => [
        'name' => "Rhyperior",
        'type' => [PokemonType::GROUND, PokemonType::ROCK],
    ],
    PokedexNo::TANGROWTH => [
        'name' => "Tangrowth",
        'type' => [PokemonType::GRASS],
    ],
    PokedexNo::ELECTIVIRE => [
        'name' => "Electivire",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::MAGMORTAR => [
        'name' => "Magmortar",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::TOGEKISS => [
        'name' => "Togekiss",
        'type' => [PokemonType::FAIRY, PokemonType::FLYING],
    ],
    PokedexNo::YANMEGA => [
        'name' => "Yanmega",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::LEAFEON => [
        'name' => "Leafeon",
        'type' => [PokemonType::GRASS],
        'friendship' => 35,
    ],
    PokedexNo::GLACEON => [
        'name' => "Glaceon",
        'type' => [PokemonType::ICE],
        'friendship' => 35,
    ],
    PokedexNo::GLISCOR => [
        'name' => "Gliscor",
        'type' => [PokemonType::GROUND, PokemonType::FLYING],
    ],
    PokedexNo::MAMOSWINE => [
        'name' => "Mamoswine",
        'type' => [PokemonType::ICE, PokemonType::GROUND],
    ],
    PokedexNo::PORYGON_Z => [
        'name' => "Porygon-Z",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::GALLADE => [
        'name' => "Gallade",
        'type' => [PokemonType::PSYCHIC, PokemonType::FIGHTING],
        'friendship' => 35,
    ],
    PokedexNo::PROBOPASS => [
        'name' => "Probopass",
        'type' => [PokemonType::ROCK, PokemonType::STEEL],
    ],
    PokedexNo::DUSKNOIR => [
        'name' => "Dusknoir",
        'type' => [PokemonType::GHOST],
        'friendship' => 35,
    ],
    PokedexNo::FROSLASS => [
        'name' => "Froslass",
        'type' => [PokemonType::ICE, PokemonType::GHOST],
    ],
    PokedexNo::SYLVEON => [
        'name' => "Sylveon",
        'type' => [PokemonType::FAIRY],
    ],
    PokedexNo::WYRDEER => [
        'name' => "Wyrdeer",
        'type' => [PokemonType::NORMAL, PokemonType::PSYCHIC],
        'friendship' => 50,
    ],
    PokedexNo::KLEAVOR => [
        'name' => "Kleavor",
        'type' => [PokemonType::BUG, PokemonType::ROCK],
        'friendship' => 50,
    ],
    PokedexNo::URSALUNA => [
        'name' => "Ursaluna",
        'type' => [PokemonType::GROUND, PokemonType::NORMAL],
        'friendship' => 50,
    ],
    PokedexNo::ANNIHILAPE => [
        'name' => "Annihilape",
        'type' => [PokemonType::FIGHTING, PokemonType::GHOST],
        'friendship' => 50,
    ],
    PokedexNo::FARIGIRAF => [
        'name' => "Farigiraf",
        'type' => [PokemonType::NORMAL, PokemonType::PSYCHIC],
        'friendship' => 50,
    ],
    PokedexNo::DUDUNSPARCE => [
        'name' => "Dudunsparce",
        'type' => [PokemonType::NORMAL],
        'friendship' => 50,
    ],
];
