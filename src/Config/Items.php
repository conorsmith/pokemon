<?php

declare(strict_types=1);

use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemType;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;

return [
    ItemId::POKE_BALL       => [
        'name'     => "Poké Ball",
        'imageUrl' => "/assets/items/Bag_Pok%C3%A9_Ball_Sprite.png",
        'type'     => ItemType::POKE_BALL,
    ],
    ItemId::GREAT_BALL      => [
        'name'     => "Great Ball",
        'imageUrl' => "/assets/items/Bag_Great_Ball_Sprite.png",
        'type'     => ItemType::POKE_BALL,
    ],
    ItemId::ULTRA_BALL      => [
        'name'     => "Ultra Ball",
        'imageUrl' => "/assets/items/Bag_Ultra_Ball_Sprite.png",
        'type'     => ItemType::POKE_BALL,
    ],
    ItemId::RARE_CANDY      => [
        'name'     => "Rare Candy",
        'imageUrl' => "/assets/items/Bag_Rare_Candy_Sprite.png",
        'hasUse'   => true,
    ],
    ItemId::CHALLENGE_TOKEN => [
        'name'     => "Challenge Token",
        'imageUrl' => "/assets/items/Bag_Contest_Pass_Sprite.png",
    ],
    ItemId::OVAL_CHARM      => [
        'name'     => "Oval Charm",
        'imageUrl' => "/assets/items/Bag_Oval_Charm_Sprite.png",
        'hasUse'   => true,
    ],
    ItemId::FIRE_STONE      => [
        'name'     => "Fire Stone",
        'imageUrl' => "/assets/items/Bag_Fire_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 6,
    ],
    ItemId::WATER_STONE     => [
        'name'     => "Water Stone",
        'imageUrl' => "/assets/items/Bag_Water_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 6,
    ],
    ItemId::THUNDER_STONE   => [
        'name'     => "Thunder Stone",
        'imageUrl' => "/assets/items/Bag_Thunder_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 7,
    ],
    ItemId::LEAF_STONE      => [
        'name'     => "Leaf Stone",
        'imageUrl' => "/assets/items/Bag_Leaf_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 7,
    ],
    ItemId::MOON_STONE      => [
        'name'     => "Moon Stone",
        'imageUrl' => "/assets/items/Bag_Moon_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 6,
    ],
    ItemId::SUN_STONE       => [
        'name'     => "Sun Stone",
        'imageUrl' => "/assets/items/Bag_Sun_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 5,
    ],
    ItemId::ICE_STONE       => [
        'name'     => "Ice Stone",
        'imageUrl' => "/assets/items/Bag_Ice_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 6,
    ],
    ItemId::DUSK_STONE      => [
        'name'     => "Dusk Stone",
        'imageUrl' => "/assets/items/Bag_Dusk_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 4,
    ],
    ItemId::SHINY_STONE     => [
        'name'     => "Shiny Stone",
        'imageUrl' => "/assets/items/Bag_Shiny_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 4,
    ],
    ItemId::DAWN_STONE      => [
        'name'     => "Dawn Stone",
        'imageUrl' => "/assets/items/Bag_Dawn_Stone_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 2,
    ],
    ItemId::DRAGON_SCALE    => [
        'name'     => "Dragon Scale",
        'imageUrl' => "/assets/items/Bag_Dragon_Scale_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::KINGS_ROCK      => [
        'name'     => "King's Rock",
        'imageUrl' => "/assets/items/Bag_King%27s_Rock_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 2,
    ],
    ItemId::METAL_COAT      => [
        'name'     => "Metal Coat",
        'imageUrl' => "/assets/items/Bag_Metal_Coat_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 2,
    ],
    ItemId::UPGRADE         => [
        'name'     => "Upgrade",
        'imageUrl' => "/assets/items/Bag_Up-Grade_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::DUBIOUS_DISC    => [
        'name'     => "Dubious Disc",
        'imageUrl' => "/assets/items/Bag_Dubious_Disc_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::ELECTIRIZER     => [
        'name'     => "Electirizer",
        'imageUrl' => "/assets/items/Bag_Electirizer_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::MAGMARIZER      => [
        'name'     => "Magmarizer",
        'imageUrl' => "/assets/items/Bag_Magmarizer_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::PROTECTOR       => [
        'name'     => "Protector",
        'imageUrl' => "/assets/items/Bag_Protector_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::BLACK_AUGURITE  => [
        'name'     => "Black Augurite",
        'imageUrl' => "/assets/items/Bag_Charcoal_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::PEAT_BLOCK      => [
        'name'     => "Peat Block",
        'imageUrl' => "/assets/items/Bag_Peat_Block_SV_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::LINKING_CORD    => [
        'name'     => "Linking Cord",
        'imageUrl' => "/assets/items/Bag_Escape_Rope_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 4,
    ],
    ItemId::RAZOR_FANG      => [
        'name'     => "Razor Fang",
        'imageUrl' => "/assets/items/Bag_Razor_Fang_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::RAZOR_CLAW      => [
        'name'     => "Razor Claw",
        'imageUrl' => "/assets/items/Bag_Razor_Claw_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 2,
    ],
    ItemId::PRISM_SCALE     => [
        'name'     => "Prism Scale",
        'imageUrl' => "/assets/items/Bag_Prism_Scale_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::REAPER_CLOTH    => [
        'name'     => "Reaper Cloth",
        'imageUrl' => "/assets/items/Bag_Reaper_Cloth_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::DEEP_SEA_TOOTH  => [
        'name'     => "Deep Sea Tooth",
        'imageUrl' => "/assets/items/Bag_Deep_Sea_Tooth_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::DEEP_SEA_SCALE  => [
        'name'     => "Deep Sea Scale",
        'imageUrl' => "/assets/items/Bag_Deep_Sea_Scale_Sprite.png",
        'hasUse'   => true,
        'type'     => ItemType::EVOLUTION,
        'targets'  => 1,
    ],
    ItemId::BLACK_BELT      => [
        'name'     => "Black Belt",
        'imageUrl' => "/assets/items/Bag_Black_Belt_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::FIGHTING,
        ],
    ],
    ItemId::BLACK_GLASSES   => [
        'name'     => "Black Glasses",
        'imageUrl' => "/assets/items/Bag_Black_Glasses_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::DARK,
        ],
    ],
    ItemId::CHARCOAL        => [
        'name'     => "Charcoal",
        'imageUrl' => "/assets/items/Bag_Charcoal_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::FIRE,
        ],
    ],
    ItemId::DRAGON_FANG     => [
        'name'     => "Dragon Fang",
        'imageUrl' => "/assets/items/Bag_Dragon_Fang_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::DRAGON,
        ],
    ],
    ItemId::HARD_STONE      => [
        'name'     => "Hard Stone",
        'imageUrl' => "/assets/items/Bag_Hard_Stone_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::ROCK,
        ],
    ],
    ItemId::MAGNET          => [
        'name'     => "Magnet",
        'imageUrl' => "/assets/items/Bag_Magnet_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::ELECTRIC,
        ],
    ],
    ItemId::MIRACLE_SEED    => [
        'name'     => "Miracle Seed",
        'imageUrl' => "/assets/items/Bag_Miracle_Seed_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::GRASS,
        ],
    ],
    ItemId::MYSTIC_WATER    => [
        'name'     => "Mystic Water",
        'imageUrl' => "/assets/items/Bag_Mystic_Water_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::WATER,
        ],
    ],
    ItemId::NEVER_MELT_ICE  => [
        'name'     => "Never-Melt Ice",
        'imageUrl' => "/assets/items/Bag_Never-Melt_Ice_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::ICE,
        ],
    ],
    ItemId::POISON_BARB     => [
        'name'     => "Poison Barb",
        'imageUrl' => "/assets/items/Bag_Poison_Barb_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::POISON,
        ],
    ],
    ItemId::SHARP_BEAK      => [
        'name'     => "Sharp Beak",
        'imageUrl' => "/assets/items/Bag_Sharp_Beak_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::FLYING,
        ],
    ],
    ItemId::SILK_SCARF      => [
        'name'     => "Silk Scarf",
        'imageUrl' => "/assets/items/Bag_Silk_Scarf_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::NORMAL,
        ],
    ],
    ItemId::SILVER_POWDER   => [
        'name'     => "Silver Powder",
        'imageUrl' => "/assets/items/Bag_Silver_Powder_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::BUG,
        ],
    ],
    ItemId::SOFT_SAND       => [
        'name'     => "Soft Sand",
        'imageUrl' => "/assets/items/Bag_Soft_Sand_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::GROUND,
        ],
    ],
    ItemId::SPELL_TAG       => [
        'name'     => "Spell Tag",
        'imageUrl' => "/assets/items/Bag_Spell_Tag_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::GHOST,
        ],
    ],
    ItemId::TWISTED_SPOON   => [
        'name'     => "Twisted Spoon",
        'imageUrl' => "/assets/items/Bag_Twisted_Spoon_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::PSYCHIC,
        ],
    ],
    ItemId::FAIRY_FEATHER => [
        'name'     => "Fairy Feather",
        'imageUrl' => "/assets/items/36px-Bag_Fairy_Feather_SV_Sprite.png",
        'type'     => ItemType::HELD,
        'effect'   => [
            'typeEnhance' => PokemonType::FAIRY,
        ],
    ],
    ItemId::HP_UP           => [
        'name'     => "HP Up",
        'imageUrl' => "/assets/items/Bag_HP_Up_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
    ItemId::PROTEIN         => [
        'name'     => "Protein",
        'imageUrl' => "/assets/items/Bag_Protein_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
    ItemId::IRON            => [
        'name'     => "Iron",
        'imageUrl' => "/assets/items/Bag_Iron_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
    ItemId::CALCIUM         => [
        'name'     => "Calcium",
        'imageUrl' => "/assets/items/Bag_Calcium_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
    ItemId::ZINC            => [
        'name'     => "Zinc",
        'imageUrl' => "/assets/items/Bag_Zinc_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
    ItemId::CARBOS          => [
        'name'     => "Carbos",
        'imageUrl' => "/assets/items/Bag_Carbos_Sprite.png",
        'type'     => ItemType::STATS,
        'hasUse'   => true,
    ],
];
