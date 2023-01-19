<?php
declare(strict_types=1);

use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\PokemonType;

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
                'level' => 32,
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
                'level' => 16,
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
    ],
    PokedexNo::NIDOKING => [
        'name' => "Nidoking",
        'type' => [PokemonType::POISON, PokemonType::GROUND],
    ],
    PokedexNo::CLEFAIRY => [
        'name' => "Clefairy",
        'type' => [PokemonType::FAIRY],
    ],
    PokedexNo::CLEFABLE => [
        'name' => "Clefable",
        'type' => [PokemonType::FAIRY],
    ],
    PokedexNo::VULPIX => [
        'name' => "Vulpix",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::NINETALES => [
        'name' => "Ninetales",
        'type' => [PokemonType::FIRE],
    ],
    PokedexNo::JIGGLYPUFF => [
        'name' => "Jigglypuff",
        'type' => [PokemonType::NORMAL, PokemonType::FAIRY],
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
    ],
    PokedexNo::ODDISH => [
        'name' => "Oddish",
        'type' => [PokemonType::GROUND, PokemonType::POISON],
        'evolutions' => [
            PokedexNo::GLOOM => [
                'level' => 21,
            ],
        ],
    ],
    PokedexNo::GLOOM => [
        'name' => "Gloom",
        'type' => [PokemonType::GROUND, PokemonType::POISON],
    ],
    PokedexNo::VILEPLUME => [
        'name' => "Vileplume",
        'type' => [PokemonType::GROUND, PokemonType::POISON],
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
    ],
    PokedexNo::GROWLITHE => [
        'name' => "Growlithe",
        'type' => [PokemonType::FIRE],
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
    ],
    PokedexNo::GOLEM => [
        'name' => "Golem",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
    ],
    PokedexNo::PONYTA => [
        'name' => "Ponyta",
        'type' => [PokemonType::WATER],
        'evolutions' => [
            PokedexNo::RAPIDASH => [
                'level' => 40,
            ],
        ],
    ],
    PokedexNo::RAPIDASH => [
        'name' => "Rapidash",
        'type' => [PokemonType::WATER],
    ],
    PokedexNo::SLOWPOKE => [
        'name' => "Slowpoke",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
        'evolutions' => [
            PokedexNo::SLOWBRO => [
                'level' => 37,
            ],
            // SLOWKING
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
    ],
    PokedexNo::FARFETCHD => [
        'name' => "Farfetch’d",
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
    ],
    PokedexNo::GENGAR => [
        'name' => "Gengar",
        'type' => [PokemonType::GHOST, PokemonType::POISON],
    ],
    PokedexNo::ONIX => [
        'name' => "Onix",
        'type' => [PokemonType::ROCK, PokemonType::GROUND],
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
    ],
    PokedexNo::CHANSEY => [
        'name' => "Chansey",
        'type' => [PokemonType::NORMAL],
    ],
    PokedexNo::TANGELA => [
        'name' => "Tangela",
        'type' => [PokemonType::GRASS],
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
    ],
    PokedexNo::STARMIE => [
        'name' => "Starmie",
        'type' => [PokemonType::WATER, PokemonType::PSYCHIC],
    ],
    PokedexNo::MRMIME => [
        'name' => "Mr. Mime",
        'type' => [PokemonType::PSYCHIC, PokemonType::FAIRY],
    ],
    PokedexNo::SCYTHER => [
        'name' => "Scyther",
        'type' => [PokemonType::BUG, PokemonType::FLYING],
    ],
    PokedexNo::JYNX => [
        'name' => "Jynx",
        'type' => [PokemonType::ICE, PokemonType::PSYCHIC],
    ],
    PokedexNo::ELECTABUZZ => [
        'name' => "Electabuzz",
        'type' => [PokemonType::ELECTRIC],
    ],
    PokedexNo::MAGMAR => [
        'name' => "Magmar",
        'type' => [PokemonType::FIRE],
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
    ],
    PokedexNo::ZAPDOS => [
        'name' => "Zapdos",
        'type' => [PokemonType::ELECTRIC, PokemonType::FLYING],
    ],
    PokedexNo::MOLTRES => [
        'name' => "Moltres",
        'type' => [PokemonType::FIRE, PokemonType::FLYING],
    ],
    PokedexNo::DRATINI => [
        'name' => "Dratini",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::DRAGONAIR => [
                'level' => 30,
            ],
        ],
    ],
    PokedexNo::DRAGONAIR => [
        'name' => "Dragonair",
        'type' => [PokemonType::DRAGON],
        'evolutions' => [
            PokedexNo::DRAGONITE => [
                'level' => 55,
            ],
        ],
    ],
    PokedexNo::DRAGONITE => [
        'name' => "Dragonite",
        'type' => [PokemonType::DRAGON, PokemonType::FLYING],
    ],
    PokedexNo::MEWTWO => [
        'name' => "Mewtwo",
        'type' => [PokemonType::PSYCHIC],
    ],
    PokedexNo::MEW => [
        'name' => "Mew",
        'type' => [PokemonType::PSYCHIC],
    ],
];
