<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

final class LocationId
{
    // KANTO
    public const PALLET_TOWN = "0998d25b-6afd-4bde-9ddc-57560660ffc3";
    public const PROFESSOR_OAKS_LAB = "2ed967a4-150a-4f91-9ccc-ec4ed2fb264b";
    public const ROUTE_1 = "0e27acd0-1d6e-458a-9ba8-7344f90761e1";
    public const VIRIDIAN_CITY = "e130f4d7-38f3-4a0b-89b4-fa8480e888ac";
    public const VIRIDIAN_GYM = "278cb200-908a-437f-b664-5dba1a1db97c";
    public const ROUTE_2 = "4f788128-22d4-4bbe-a954-029a7fd599bd";
    public const PEWTER_CITY = "d2aefee3-2743-4fea-9425-b30041eb70f2";
    public const PEWTER_GYM = "fe280ea9-801d-4e71-9360-6fc29d46b3cd";
    public const VIRIDIAN_FOREST = "689069a9-13a7-4068-a49e-5395c05a4312";
    public const DIGLETTS_CAVE = "59149839-b573-4153-b75e-0664498370f6";
    public const ROUTE_3 = "a5cd2de7-300e-4739-a222-5a0a1fed4d31";
    public const MT_MOON = "1198096c-850b-4c6c-8df6-af7a1f8c3af6";
    public const MT_MOON_F1 = "7de04a8f-0100-458c-958e-542611282bcf";
    public const MT_MOON_BF1 = "fa9371ac-d8e9-4f57-867f-cb81ff0a3254";
    public const MT_MOON_BF2 = "2d1cbf17-d7e8-4932-b80a-84541668a3d9";
    public const ROUTE_4 = "bf6db9ee-68a4-4c84-a43a-48a148307204";
    public const CERULEAN_CITY = "cf6dff48-2972-4fe9-8853-9ccba685c38e";
    public const CERULEAN_GYM = "9dea9089-871c-47b6-99c4-5b0f60d4be72";
    public const ROUTE_5 = "2ae61913-311d-4b24-87dd-934586badb5c";
    public const SAFFRON_CITY = "96ab9b1c-dcd5-47f8-97b0-13dd864ae369";
    public const SAFFRON_GYM = "9a42886a-1440-4df3-a8b8-0b51706831b6";
    public const FIGHTING_DOJO = "9d2a8a48-9cfc-4ec3-925b-990b13715d08";
    public const ROUTE_6 = "8ceee5a8-54dd-4c63-9629-40bff24f3b2d";
    public const VERMILLION_CITY = "41b38040-2b0b-4a4e-9333-67fc7a5bb003";
    public const VERMILLION_GYM = "7551e662-cd6b-4010-934b-6abfa82c4b4f";
    public const VERMILLION_HARBOUR = "c339cff4-4b91-4d31-a2a4-aa1ada551c58";
    public const SS_ANNE = "b02411f3-caa0-487a-8afc-7443700cb581";
    public const SS_ANNE_1F = "90a089dd-95b7-448c-b561-dbc2cd086740";
    public const SS_ANNE_B1F = "01e45aba-af9a-48e4-9735-b0fd974b0c14";
    public const SS_ANNE_2F = "ae23181e-2200-4fb9-aa35-c0d969276436";
    public const SS_ANNE_DECK = "b6464105-de20-4f20-be78-d28f29ef536c";
    public const ROUTE_7 = "85776d72-ece8-451f-a8b8-5b1f9c2b349b";
    public const CELADON_CITY = "57564cf4-9ac8-4b24-af13-eb158d969bb4";
    public const CELADON_GYM = "acbaddd5-3ccf-4e97-a4df-b0d512c1884b";
    public const CELADON_CONDOMINIUMS = "678c02a8-5848-4c53-b46b-7e1e5892f7f1";
    public const ROCKET_GAME_CORNER = "14315b53-fd18-4d83-81c8-591f77ba2a17";
    public const TEAM_ROCKET_HIDEOUT = "3a4fb0ff-5464-4a7d-b02b-f0d204bd8959";
    public const TEAM_ROCKET_HIDEOUT_B1F = "962d8e48-81a2-4ae2-9385-a2ac4fcbfaa1";
    public const TEAM_ROCKET_HIDEOUT_B2F = "011c4a3d-9c13-4a33-82f4-4b970aacf793";
    public const TEAM_ROCKET_HIDEOUT_B3F = "315b3968-fbf6-4c80-b885-1654b57c3131";
    public const TEAM_ROCKET_HIDEOUT_B4F = "fffe0b32-bf2d-4b65-85f0-744d3e6fb06e";
    public const ROUTE_8 = "a006849d-3c22-4b57-b6d9-3ab23f6f42cf";
    public const ROUTE_9 = "57968d07-cea1-4a9b-ac21-53609a25ea36";
    public const POWER_PLANT = "01f3a7cb-ca9e-47bc-9976-7e8dbc5c79ad";
    public const ROCK_TUNNEL = "3d4be21c-d60d-4dc2-aeda-570553d1599b";
    public const ROCK_TUNNEL_1F = "dca3ae52-de54-413b-a838-b4ddf6da97d5";
    public const ROCK_TUNNEL_B1F = "0d6f7674-b690-47dd-833b-602b9bf4f319";
    public const ROUTE_10 = "3d732b49-da46-4985-bd04-a59cce17ee44";
    public const LAVENDER_TOWN = "80bc57a9-d0b9-4d19-9232-5f5cdc1070ed";
    public const POKEMON_TOWER = "a277e76b-1317-4862-b306-cbe1b3e86139";
    public const POKEMON_TOWER_1F = "12c55b2c-45a6-4456-89ea-cf5adeb74069";
    public const POKEMON_TOWER_2F = "933d842a-5795-4aa8-87a9-bffd83fee5f5";
    public const POKEMON_TOWER_3F = "db3cda09-9bfe-4686-a5e0-9d9e3383e83f";
    public const POKEMON_TOWER_4F = "8944c274-4dcc-4199-83f2-833702170f4c";
    public const POKEMON_TOWER_5F = "38504bd4-8b09-4354-b79a-17e2f12e0e77";
    public const POKEMON_TOWER_6F = "0b61745c-8531-4bb5-9c72-2f5877fa277d";
    public const POKEMON_TOWER_7F = "4d3ed975-91cc-4900-8f78-09f554be30e6";
    public const SILPH_CO = "6f633080-a11a-4aea-aeba-047520168011";
    public const SILPH_CO_1F = "11d99fd7-9b0d-49be-8458-e519a285d196";
    public const SILPH_CO_2F = "5cc40f21-cddb-4851-a8a8-cada52786e94";
    public const SILPH_CO_3F = "55826deb-1220-4c77-b55b-109f0509865a";
    public const SILPH_CO_4F = "58b7b8cb-5c07-4da9-b5db-b5ddc9d86a2d";
    public const SILPH_CO_5F = "13b4a603-1969-4795-8c63-42d4930e1c82";
    public const SILPH_CO_6F = "3ff027c8-097b-4b30-aba2-56bb06fdfce9";
    public const SILPH_CO_7F = "c3e4b5b9-ec0f-4918-b66d-f9dcddc63141";
    public const SILPH_CO_8F = "b4584061-2db9-49c0-bec4-9b5c58551a19";
    public const SILPH_CO_9F = "bba27502-86f0-4b70-964c-79438fcff70a";
    public const SILPH_CO_10F = "bb53dfe9-6aec-4f4a-b8c6-4b6d2c88c87d";
    public const SILPH_CO_11F = "abbee3bb-1950-4a1b-8a0a-4c39fd8076cb";
    public const ROUTE_11 = "8e24cb82-3708-4530-aa1a-09a8465a5d2e";
    public const ROUTE_12 = "3387518a-aece-49e0-9563-ca645f881a00";
    public const ROUTE_13 = "22f4d2be-a20a-4c13-9d8e-1085b59e49f4";
    public const ROUTE_14 = "cf81b643-7eb8-407d-8975-44c26b09533a";
    public const ROUTE_15 = "4bc982c5-1303-42cd-b55b-6cdfc3402d15";
    public const ROUTE_16 = "2f0bc600-51c8-4621-9c72-124b5349beb2";
    public const ROUTE_17 = "14ff0830-f6b9-413c-8b62-cca8d9943755";
    public const ROUTE_18 = "ed95c624-3b6e-410e-b527-62f56d17f5f6";
    public const FUCHSIA_CITY = "e4f336d0-78a0-49bb-87a8-beceb810c097";
    public const FUCHSIA_GYM = "7406717d-0a53-4539-ba87-08c84adb5152";
    public const KANTO_SAFARI_ZONE_S = "0383556c-0b2e-4a33-a178-1b078fc60352";
    public const KANTO_SAFARI_ZONE_N = "a44f53b0-5bb8-4fab-944b-07a1d027981e";
    public const KANTO_SAFARI_ZONE_E = "e0958c26-8d73-48a9-9e13-c4f73d6ae1e8";
    public const KANTO_SAFARI_ZONE_W = "8dbd8491-1e94-4a2b-8bfe-b3e019d92c6f";
    public const ROUTE_19 = "27940ef2-9539-4cdf-b16b-1551cf5259e3";
    public const ROUTE_20 = "4311bda4-3e6a-46be-944d-4df4301c696d";
    public const SEAFOAM_ISLANDS_1F = "3d36df91-cc9b-474a-9ae9-c53b5d15470b";
    public const SEAFOAM_ISLANDS_B1F = "9959716c-6262-4372-be5e-8814449120ee";
    public const SEAFOAM_ISLANDS_B2F = "d0f13735-54f4-4b57-9294-916bc28c6106";
    public const SEAFOAM_ISLANDS_B3F = "9a20ddc3-943f-4934-b728-a05b7a02ec32";
    public const SEAFOAM_ISLANDS_B4F = "fee3a878-6b7e-43d7-b801-a753f391f4d5";
    public const CINNABAR_ISLAND = "a5520b4e-314b-4893-b56d-63b102295956";
    public const CINNABAR_GYM = "72e0a851-f383-4b60-a8e3-95e2c7626d47";
    public const POKEMON_MANSION = "ba90917a-2258-42ae-a4c7-bb074de9f01b";
    public const ROUTE_21 = "e2d59a4a-52c0-4daf-98e6-d7714bbb1c6a";
    public const ROUTE_22 = "ef4eb649-cf0c-40f1-a11b-601eb4d78a3c";
    public const POKEMON_LEAGUE_FRONT_GATE = "5d769d58-8fb9-4b8f-8858-ad0af184aab4";
    public const VICTORY_ROAD = "f8581c9e-88cb-4aee-ba7c-93ec85f30202";
    public const VICTORY_ROAD_1F = "2335aa04-4bde-421c-b27e-a680cb3e36b0";
    public const VICTORY_ROAD_2F = "32f2851c-6430-4050-a253-b6191888a537";
    public const VICTORY_ROAD_3F = "6dcf71fd-23dc-4313-8cd7-1d7fc513eba4";
    public const INDIGO_PLATEAU = "36c7585c-c0df-4bd5-8e50-5c92487d44d8";
    public const KANTO_LEAGUE_CHAMBER = "9f3e88e4-b42a-41ca-ac94-9eba2d215d79";
    public const JOHTO_LEAGUE_CHAMBER = "b515a271-d67a-49c9-8030-4f7208f01112";
    public const ROUTE_23 = "91743725-50c2-4185-925c-a1dad7db2c90";
    public const ROUTE_24 = "04fe98e1-051d-4eb4-90bf-8e788b33fda6";
    public const ROUTE_25 = "bb9a23b0-c473-46ae-b663-fdabc187a7f0";
    public const CERULEAN_CAVE_1F = "feeeeeca-6304-4072-b2c5-3f7babcfa171";
    public const CERULEAN_CAVE_2F = "f3cfa62e-5e98-4814-b8bf-ef43abaa89e2";
    public const CERULEAN_CAVE_B1F = "c4ab39c2-f3b0-4828-aacb-2d26be97a1a2";
    public const SEAGALLOP_FERRY = "e081a16d-89f3-46f0-aae3-1e4ce917d7e1";
    public const KNOT_ISLAND = "95c95627-3025-4347-9d15-d5aeed9d957e";
    public const TREASURE_BEACH = "a3025bfb-a666-4dba-be6a-8858e5176770";
    public const KINDLE_ROAD = "5cde0f21-51f5-4501-9529-16a6e4d7dd2d";
    public const MT_EMBER = "5c011324-cf7b-406d-b6b3-08c4d724a06c";
    public const MT_EMBER_BASE = "c873123a-4c95-42cf-bfae-caedcf2c949d";
    public const MT_EMBER_SUMMIT_PATH_1 = "3afc8203-ab2b-401f-a778-c983c8de7942";
    public const MT_EMBER_SUMMIT_PATH_2 = "cdd3822d-7c5b-46bd-acf6-289e5c5ffa1a";
    public const MT_EMBER_SUMMIT_PATH_3 = "78275fdf-1aa7-4c20-a752-79d6968dee13";
    public const MT_EMBER_SUMMIT = "32b7307c-7252-45c1-b6b9-27c7aa98df65";
    public const MT_EMBER_1F = "dea6b623-f171-4b45-87ad-ca579a7c27bc";
    public const MT_EMBER_B1F = "5e892198-0007-4b62-984e-038be306c73d";
    public const MT_EMBER_B2F = "e36321ff-a192-4686-9fab-ffa323e54bda";
    public const MT_EMBER_B3F = "78006109-6498-4a37-b959-bbe1520aae34";
    public const MT_EMBER_B4F = "9cf15aae-3b3b-484e-aea8-45a529c8a436";
    public const MT_EMBER_B5F = "09301fa7-c8f6-4e6a-9823-62b9c0bbbb9a";
    public const BOON_ISLAND = "b13b261d-0cc1-4312-95a5-a618f2372625";
    public const CAPE_BRINK = "b0363087-8dd0-47b4-8666-70417b79eef9";
    public const KIN_ISLAND = "279429c1-eed1-4305-8d05-07d4b6ac6f01";
    public const KIN_ISLAND_PORT = "c0d2966e-049d-48a4-9ba3-3a081b42ff78";
    public const BOND_BRIDGE = "f50306b4-9d5d-429b-84b8-0c6aae0be651";
    public const BERRY_FOREST = "ebdb47e5-ae4a-4924-af41-343264523c41";
    public const FLOE_ISLAND = "b010cbc5-617a-4a5b-b4a0-3d374268ec79";
    public const ICEFALL_CAVE = "4006ac11-c3a8-4b0b-a22e-63f708f58d90";
    public const ICEFALL_CAVE_ENTRANCE = "c38c9e38-e358-46f1-ae33-2446ed2929a4";
    public const ICEFALL_CAVE_1F = "3053fe36-a4de-49d5-8333-2a6007df1fa5";
    public const ICEFALL_CAVE_B1F = "160b9f1d-c3af-4446-b7da-772bb3cd11cd";
    public const ICEFALL_CAVE_BACK_CAVE = "64d62daf-9657-4825-905d-e9a72d43e28a";
    public const CHRONO_ISLAND = "72bf3955-512e-47fe-8acc-0f284bfd4fd4";
    public const RESORT_GORGEOUS = "b0edc349-e481-4e30-b9ef-2aca3ba400a5";
    public const LOST_CAVE = "98709d6b-d117-4167-aeb0-5e879538cb5d";
    public const LOST_CAVE_1F = "6633e4a4-c7e3-42be-acc6-543feab80122";
    public const LOST_CAVE_B1F_1 = "abc39058-9c0a-429c-92c8-8f05f1053a26";
    public const LOST_CAVE_B1F_2 = "17a51b8c-d420-4c8b-8564-ed4cf1d05a9f";
    public const LOST_CAVE_B1F_3 = "cb6b7e55-c920-4635-8910-df8011cfc152";
    public const LOST_CAVE_B1F_4 = "ff227032-6007-4ee5-a916-95bd21cca88a";
    public const LOST_CAVE_B1F_5 = "9f6ce4b8-03d3-4823-a1c5-d4a3468ce4c5";
    public const LOST_CAVE_B1F_6 = "61d2d99d-f4d9-40b7-a564-4ccd512884f2";
    public const LOST_CAVE_B1F_7 = "7a2055eb-1fb4-466c-ab2e-5387e50563e9";
    public const LOST_CAVE_B1F_8 = "eadf2617-802b-4c99-9611-4513563802aa";
    public const LOST_CAVE_B1F_9 = "05819f7e-657c-47ec-a1ca-6823b65ba031";
    public const LOST_CAVE_B1F_10 = "2ff43d5d-9c89-4b35-b270-c06ae4f7aefd";
    public const LOST_CAVE_B1F_11 = "0d31273d-9e31-488b-918b-31cdadfb068c";
    public const LOST_CAVE_B1F_12 = "fc1cca5f-654c-4cde-9311-2e462dd0ba1e";
    public const LOST_CAVE_B1F_13 = "3c986803-62a4-4d80-b4ba-fb35e5b1bedf";
    public const LOST_CAVE_B1F_14 = "674c7a6a-0325-4ca8-80e0-914578e58bb1";
    public const WATER_LABYRINTH = "e9909a1d-b360-4698-bd42-bd0ce547c494";
    public const CHRONO_ISLE_MEADOW = "aa2811ed-bfab-4cca-b654-18cc015f5929";
    public const ROCKET_WAREHOUSE = "d091ef74-8957-4ebd-951c-6afd5a5939ec";
    public const MEMORIAL_PILLAR = "5f70577e-5cb0-4139-8c23-cea84ad4fd3b";
    public const FORTUNE_ISLAND = "ff094591-f59c-4ce5-a9e6-79702a6a3a5b";
    public const WATER_PATH = "cd3965e4-69a3-4bd4-b7e6-e01d49e2353a";
    public const RUIN_VALLEY = "7dc5891b-d71a-4c1e-9231-2f0e4cb5b179";
    public const DOTTED_HOLE = "664f9eea-3634-4fff-beb0-49134d306f72";
    public const GREEN_PATH = "ac482604-cbc9-4859-8124-a0e979b83cc4";
    public const PATTERN_BUSH = "74521893-f3bc-4f76-80ac-d517273d35e9";
    public const OUTCAST_ISLAND = "6c45fb62-1044-4374-b4f3-c54a411578e9";
    public const ALTERING_CAVE = "05cb794f-8be4-4acd-a5f6-241c706a4b13";
    public const QUEST_ISLAND = "f3c7a4dc-27d9-49dc-90ac-0d6a12f8c9b5";
    public const TANOBY_RUINS = "4d76eab6-9f02-4e68-a558-508ae3738ad3";
    public const SEVAULT_CANYON = "16e4a61e-dfa3-4c47-955f-52f12be51c4c";
    public const CANYON_ENTRANCE = "5ca106dc-6bb6-479c-915a-f0deeb81b4db";
    public const TRAINER_TOWER = "889af4d3-0b2f-458e-b8b2-57eaa87c6b0d";
    public const TANOBY_MONEAN_CHAMBER = "0668bfe3-9992-4339-8a3d-358cc2ddf133";
    public const TANOBY_LIPTOO_CHAMBER = "8df7a80d-6b98-4657-a7c9-3e76f2eb9884";
    public const TANOBY_WEEPTH_CHAMBER = "37dba4ab-5d46-486a-96d2-7d4a6c5defd5";
    public const TANOBY_DILFORD_CHAMBER = "54d93fe9-4675-4d01-8e69-7c562e2262a0";
    public const TANOBY_SCUFIB_CHAMBER = "b033de21-f54a-4ec5-86b0-fd2621b0a064";
    public const TANOBY_RIXY_CHAMBER = "0e18eebb-4258-4de9-a033-e17eee94add4";
    public const TANOBY_VIAPOIS_CHAMBER = "2396d8c1-1e5d-44ff-a4bc-7e221c96eb30";

    // JOHTO
    public const ROUTE_26 = "4d431c27-f7e0-4b3f-937a-421af4e5bf63";
    public const ROUTE_27 = "def091ff-8479-473e-9022-75456557be33";
    public const TOHJO_FALLS = "b9f52d98-65c8-4b85-89f1-1fe731cdf95a";
    public const ROUTE_28 = "0793f081-12d6-4a22-9301-d5ef0a537488";
    public const MT_SILVER = "291e7d63-c652-4093-9543-992e4b50fbab";
    public const MT_SILVER_EXTERIOR = "4acba97c-d535-4dfc-a948-130e1d86e70c";
    public const MT_SILVER_1F = "52a8c19f-86af-4935-8f7b-9dbde4e7809d";
    public const MT_SILVER_2F = "6b85f923-fb14-46eb-82a1-9c291ec5a79f";
    public const MT_SILVER_3F = "34f06989-61c5-4975-9749-b89c73f885ee";
    public const MT_SILVER_LOWER_MOUNTAINSIDE = "844e6717-f61f-407f-b93d-d6263b25d759";
    public const MT_SILVER_UPPER_MOUNTAINSIDE = "03b63f0e-8d04-464b-9538-d1e6957c5355";
    public const MT_SILVER_SUMMIT = "effbbaae-836b-4b6f-97d4-a5a8be675e09";
    public const NEW_BARK_TOWN = "da7816a2-d476-4968-b60e-c5428b970131";
    public const PROFESSOR_ELMS_LAB = "265eed95-5ad2-4d61-a64f-a66842859326";
    public const ROUTE_29 = "4678a84c-4e6d-4030-9e2e-2c5a7436f1f7";
    public const CHERRYGROVE_CITY = "d3709b73-1230-40da-845e-5ea9f50775f2";
    public const ROUTE_30 = "8737ff23-d092-407c-8a98-9f1fd7d93910";
    public const ROUTE_31 = "d1a20d4f-af06-4bd4-af40-7b07d2084ca1";
    public const DARK_CAVE = "7254ec8e-e993-4687-b018-946f3585ce2f";
    public const DARK_CAVE_WEST = "e51d6191-c00a-413e-a54d-99cc55e6180d";
    public const DARK_CAVE_EAST = "7e0ef702-18e9-474e-a967-dd635bb5d98c";
    public const VIOLET_CITY = "a9f502e7-230f-4aea-828f-4d95896927a7";
    public const VIOLET_GYM = "7932b248-d78b-4989-8bd7-b4517902c1ec";
    public const SPROUT_TOWER = "5442608c-a4a3-4bde-89ad-ad9a8f8807ce";
    public const SPROUT_TOWER_1F = "94fc7786-f9f9-4cf9-a9bc-05ba32279b09";
    public const SPROUT_TOWER_2F = "0a690058-9ec3-492d-b01c-d9c8ae53541e";
    public const SPROUT_TOWER_3F = "2977b1e5-648b-4519-8500-02db8cfb8332";
    public const ROUTE_32 = "a4797456-c8c5-477c-b47c-3fe25d8c22e2";
    public const RUINS_OF_ALPH = "810b157c-d233-4038-8bda-e722c3b5e671";
    public const RUINS_OF_ALPH_OUTSIDE = "51e7f69f-aa1a-4a06-8546-08bbcd59da52";
    public const RUINS_OF_ALPH_CHAMBER = "a51a26e5-18c3-43c1-97fe-7f70dd4eb3f8";
    public const UNION_CAVE = "e5dcb38c-6034-4050-9711-031f402e0834";
    public const UNION_CAVE_1F = "f294b3ef-6d64-4b3c-9167-6f20287c59b1";
    public const UNION_CAVE_B1F = "1cbcb14f-f9cc-41c3-9273-03d53d44b790";
    public const UNION_CAVE_B2F = "9249014f-fb72-49fc-8b93-5d9fd5caa51b";
    public const ROUTE_33 = "4a23c130-b8f4-4f6e-ba83-42705e184caa";
    public const AZALEA_TOWN = "c335b0e9-2b82-43c3-a9d8-f2b7f12e3e2e";
    public const AZALEA_GYM = "10fc6f41-4dd2-4e87-b8a9-94ed63a05686";
    public const SLOWPOKE_WELL = "32ba6ca0-7334-4447-9074-55cf7562c5b2";
    public const SLOWPOKE_WELL_ENTRANCE = "91ebbdbc-c7c0-48dd-a52b-cef10c44c6d9";
    public const SLOWPOKE_WELL_B1F = "b1e8ef23-7ed5-4699-b3fd-c5ca85a12f8d";
    public const SLOWPOKE_WELL_B2F = "59a3cd84-9754-4e96-84ba-e9bde79ae097";
    public const ILEX_FOREST = "8074c97b-e20b-420b-bf7e-805698ddfd0f";
    public const ROUTE_34 = "60e23471-1179-41a2-b6d9-50cef3f357f6";
    public const GOLDENROD_CITY = "de72d39c-94ab-472b-a695-ac693067a919";
    public const GOLDENROD_BILLS_HOUSE = "b3b16055-cf92-4fac-a28e-3c5603c39528";
    public const GOLDENROD_GAME_CORNER = "4c4989dd-6912-41d1-a36a-4a578a8da8c9";
    public const GOLDENROD_TUNNEL = "88ff330a-9d52-4aed-8e7b-41e395971804";
    public const GOLDENROD_TUNNEL_B1F = "e3f8b50b-f883-4c35-aada-1f17ce5ddf23";
    public const GOLDENROD_TUNNEL_B2F = "4146da56-9681-4de7-9dc9-d2b5f7ec53b4";
    public const GOLDENROD_TUNNEL_WAREHOUSE = "e5d512dc-30af-4acd-8a2d-92b042f86fba";
    public const GOLDENROD_RADIO_TOWER = "a82e665b-0eca-4452-9d16-63c871fb84b3";
    public const GOLDENROD_RADIO_TOWER_1F = "7ef0fd3d-d4a4-475c-b36c-2e3c1e88baa3";
    public const GOLDENROD_RADIO_TOWER_2F = "28501752-8307-4d77-8440-2576ac11bd80";
    public const GOLDENROD_RADIO_TOWER_3F = "b819727e-eb64-45af-bfcb-81f582fee53c";
    public const GOLDENROD_RADIO_TOWER_4F = "1311310e-c4ee-4138-be2a-bd40e697826a";
    public const GOLDENROD_RADIO_TOWER_5F = "5f326850-09c1-4c21-aa7a-886b039ee9bd";
    public const GOLDENROD_RADIO_TOWER_OBSERVATION_DECK = "9a7c6be1-d4aa-49d3-b82d-7344c9592433";
    public const GOLDENROD_MAGNET_TRAIN_STATION = "98f9cde4-1eeb-42db-8f70-6aa81451e15a";
    public const SAFFRON_MAGNET_TRAIN_STATION = "acba49ea-4524-4867-b4ea-e08fa62c3805";
    public const MAGNET_TRAIN = "b5bc6f54-1f6c-4d3b-96d8-e52e30e19ad2";
    public const GOLDENROD_GYM = "e255f8a1-dc6c-4a39-9895-cfbd50c03c1e";
    public const ROUTE_35 = "a82822f6-e700-4040-9185-3f14642d8e99";
    public const NATIONAL_PARK = "467651e6-7014-4cb2-a503-607523117826";
    public const ROUTE_36 = "bf4ad969-842a-4bef-ab62-914140ceda66";
    public const ROUTE_37 = "6a5c2cbf-af86-4b5f-8cf7-838507d5202f";
    public const ECRUTEAK_CITY = "6513b181-4611-4f60-a063-f74da6b766b5";
    public const ECRUTEAK_GYM = "829a04ed-51b3-4b93-bead-b4e4f4d52ba8";
    public const BURNED_TOWER = "45332893-756d-4d3d-933e-03750f4e7091";
    public const BURNED_TOWER_1F = "0de6d72c-6313-4ba1-b7ee-855ef7c0e2fe";
    public const BURNED_TOWER_B1F = "5da1fde7-ad17-4144-82b9-0b60cd682a20";
    public const ECRUTEAK_DANCE_THEATRE = "64812ad6-aee4-4809-a141-07270054c8d9";
    public const BELL_TOWER = "7dc9ae10-abcc-459d-b8d5-5afdfd10938c";
    public const BELL_TOWER_1F = "3a1213da-850c-494c-a8d9-e9eb4bed76a0";
    public const BELL_TOWER_2F = "f1af98f4-10e1-4013-b355-818b3fe2462f";
    public const BELL_TOWER_3F = "4d3f8f05-be1f-477f-8f52-0d229e9ea15e";
    public const BELL_TOWER_4F = "2941fac1-2a2c-4a14-849d-e9040dcec575";
    public const BELL_TOWER_5F = "564fd3ce-ac10-422e-ad0f-cca2edc0054c";
    public const BELL_TOWER_6F = "2ea83273-a67d-4303-a43d-a0d40d965956";
    public const BELL_TOWER_7F = "3bd752e7-45d1-4181-90b3-dea002b6be67";
    public const BELL_TOWER_8F = "82b71fbc-57c5-4b0e-8461-d28357ad98df";
    public const BELL_TOWER_9F = "36a9689b-b71b-4319-a728-7a4d77420629";
    public const BELL_TOWER_10F = "81c11cbc-e417-4c95-a6a1-47b726df50d4";
    public const BELL_TOWER_ROOF = "bb28ac83-ab68-4f8b-a214-d129b01431e5";
    public const ROUTE_38 = "57859799-bf75-4831-896e-4148f09c86b8";
    public const ROUTE_39 = "a7db5fcc-cf48-46bf-a660-d2e377060009";
    public const OLIVINE_CITY = "bd5e8ff2-f793-4c5d-9aba-e9a680f4763c";
    public const OLIVINE_GYM = "521ecd98-cf0f-4d9c-8a70-ebbb4bcfee88";
    public const GLITTER_LIGHTHOUSE = "aa9eadfd-e9ed-4a0b-9531-84c815f7290d";
    public const GLITTER_LIGHTHOUSE_1F = "3d22a24e-ea73-4e5f-a2b7-1bb63d44b283";
    public const GLITTER_LIGHTHOUSE_2F = "6d27a803-ab83-419a-932b-d6be95deb7ea";
    public const GLITTER_LIGHTHOUSE_3F = "a8b86565-020f-49f1-a6e8-ba1c5897eb60";
    public const GLITTER_LIGHTHOUSE_EXTERIOR = "0321b407-5a47-4461-b61a-857ea7a3f411";
    public const GLITTER_LIGHTHOUSE_4F = "c2f0e8d5-f44d-4256-b241-eabd6079c321";
    public const GLITTER_LIGHTHOUSE_5F = "571f3589-335e-4c5f-8bd5-9027b2c6a9f3";
    public const GLITTER_LIGHTHOUSE_LIGHT_ROOM = "b3100fba-38ee-4fd0-b49e-a7dc983c5772";
    public const SS_AQUA = "f649c961-dbfc-4602-992c-9a3ebe0d0c4e";
    public const SS_AQUA_1F = "85882dda-76f6-4ede-bcac-b20678c0c30b";
    public const SS_AQUA_B1F = "abf6a931-e224-4ed2-b90e-d5bd3148da9c";
    public const ROUTE_40 = "ac6b0c48-f16a-483d-8ac8-c1af668a2f00";
    public const ROUTE_41 = "cc782fe5-7bcf-4914-9f34-bcaaf4785261";
    public const WHIRL_ISLANDS = "a08d5bbb-856e-4e21-beda-32ae6a4319ea";
    public const WHIRL_ISLANDS_1F = "8dd06af7-0fcc-4c7d-9fca-26b33e4ed2fc";
    public const WHIRL_ISLANDS_B1F = "3756b828-2877-4988-b1ec-14bf799c03c8";
    public const WHIRL_ISLANDS_B2F = "67b95dda-75b7-4c75-bfbf-e5479717692f";
    public const WHIRL_ISLANDS_B3F = "e0842da4-ae8f-47c7-9f51-2e56d130b244";
    public const CIANWOOD_CITY = "83a7d80b-0141-4a69-a9b6-322d1f48357d";
    public const CIANWOOD_GYM = "6e0f7196-a30b-4094-9c10-06590150003d";
    public const CLIFF_GATE_EDGE = "63a57bb4-a81c-4d14-ac6a-f2b4d95438fb";
    public const ROUTE_47 = "2afbe576-f908-40a4-b2cb-eae6ce7a1e6e";
    public const CLIFF_CAVE = "26d1674d-b3fa-4fcf-9f4b-a99b4c56943d";
    public const ROUTE_48 = "7d01ebc5-33ca-4681-aaa8-8649199fdc20";
    public const JOHTO_SAFARI_ZONE = "115a19bd-8c4f-4072-b701-1843e04abb12";
    public const JOHTO_SAFARI_ZONE_GATE = "e4ce56a8-9c3c-4252-88ad-1220349d7a4a";
    public const JOHTO_SAFARI_ZONE_PEAK = "8ab048a5-597e-4279-94c4-eb813c4c21fe";
    public const JOHTO_SAFARI_ZONE_DESERT = "08f4e109-7894-46f3-82ea-e0265fe7cc5a";
    public const JOHTO_SAFARI_ZONE_PLAINS = "70667e32-e945-4766-b762-a87436b2dd94";
    public const JOHTO_SAFARI_ZONE_MEADOW = "87cb6e12-1b6c-472d-bc3f-521b15777b9b";
    public const JOHTO_SAFARI_ZONE_FOREST = "6486d7a8-7306-47a1-9a27-09c7c6c1f046";
    public const JOHTO_SAFARI_ZONE_SWAMP = "2506bb61-2d00-4b02-8b8b-1ee89d35759c";
    public const JOHTO_SAFARI_ZONE_MARSHLAND = "a4d1b070-c883-4ee2-a17a-2cfc3674b064";
    public const JOHTO_SAFARI_ZONE_MOUNTAIN = "c99eab29-a4a3-4e56-b6d5-6c15554db461";
    public const JOHTO_SAFARI_ZONE_ROCKY_BEACH = "9003cda1-58b1-47c7-920e-f6a000d913a4";
    public const JOHTO_SAFARI_ZONE_WASTELAND = "b80eaf09-135e-4017-90ab-30fac6b0744e";
    public const JOHTO_SAFARI_ZONE_SAVANNAH = "c1352ad3-d1e7-45b0-b40a-e7e333951482";
    public const JOHTO_SAFARI_ZONE_WETLAND = "49e510ec-f68b-4969-9895-83c034ad4dc0";
    public const ROUTE_42 = "39cb5279-2b12-4b22-b75c-345fb05b5c9b";
    public const MT_MORTAR = "18b5d14a-96b7-4ee9-94cf-6794c3d2058c";
    public const MT_MORTAR_1F_ENTRANCE = "fdad0de0-4fd1-49eb-a766-5c0f2a52981c";
    public const MT_MORTAR_1F_BACK = "7bee0958-3ef2-4d21-80af-c78874cc1602";
    public const MT_MORTAR_2F = "07b87ebe-0e36-4c64-8734-f4ae3d452cdd";
    public const MT_MORTAR_B1F = "86abea0f-7722-4d8b-9b91-02b34c5ad7c4";
    public const MAHOGANY_TOWN = "3dc5dccd-65cd-4ffd-b7a6-f9f909dae368";
    public const MAHOGANY_GYM = "8b5110bc-6f3e-4928-a3a9-1adfaf524b3b";
    public const MAHOGANY_SOUVENIR_SHOP = "237031e9-b6f1-409d-ac91-77e6759a3de6";
    public const TEAM_ROCKET_HQ = "4bf23324-db6f-47ba-bb71-87891960a241";
    public const TEAM_ROCKET_HQ_B1F = "5075a379-19d0-47d8-8e07-b0380d960d75";
    public const TEAM_ROCKET_HQ_B2F = "2a6a05b0-d8b4-4e7b-a0db-dca478a1ae09";
    public const TEAM_ROCKET_HQ_B3F = "f1151fb6-002e-4991-bd5d-55afebe87c9e";
    public const ROUTE_43 = "74530fe0-de37-444f-bf53-d43fdbb5c4bb";
    public const LAKE_OF_RAGE = "a67cb480-ca11-4373-ab3e-1bc2dcc31999";
    public const ROUTE_44 = "c360f024-5f19-4a48-8dd3-38597e2f803e";
    public const ICE_PATH = "2f990dca-5c3e-4ecf-9836-6d5e9ba349fb";
    public const BLACKTHORN_CITY = "d9751b28-c4f0-4f51-b4f2-acc9019b97e4";
    public const BLACKTHORN_GYM = "4856f215-10a7-46ce-ad85-755f9f44044d";
    public const DRAGONS_DEN = "458b39f6-d21f-4f66-898f-faa0f58592fa";
    public const ROUTE_45 = "9a4d8e26-75bd-43de-bfab-d58ba512815e";
    public const ROUTE_46 = "20e5f78c-730c-4574-968b-f56d1e5fe7c7";

    // HOENN
    public const LITTLEROOT_TOWN = "42ae95fc-923d-4d5e-a7f4-017dc0995842";
    public const PROFESSOR_BIRCHS_LAB = "25022c85-de96-426f-9e38-1f4de9658769";
    public const ROUTE_101 = "bbdbe8bb-5cc6-447e-b31e-a4afd079bc01";
    public const OLDALE_TOWN = "7fa9b878-a226-478f-a5c8-39652f3cd23a";
    public const ROUTE_102 = "05d968e4-0972-45c7-8cc6-114d0a0c673a";
    public const ROUTE_103 = "d95d0134-b45a-40d5-8585-af6cb4db852e";
    public const PETALBURG_CITY = "e402a6a5-1cfe-41c8-98b2-0f45ea14b2e2";
    public const PETALBURG_GYM = "0b78b00b-6cd8-499e-b2f4-e25a592c9c43";
    public const ROUTE_104 = "d89f9bce-18c0-4aca-b47a-a04d7de91567";
    public const PETALBURG_WOODS = "182fae9d-388e-4ab7-a74a-3a207150b6f1";
    public const RUSTBORO_CITY = "94647e89-6030-4d0c-9811-4b757503631b";
    public const RUSTBORO_GYM = "b07148d3-6100-4b05-9041-e1bfd240f9e6";
    public const ROUTE_116 = "04bf6816-3ef2-4cec-85a8-8677be2a60e6";
    public const RUSTURF_TUNNEL = "fab6bf81-3e0b-4124-9b6c-efdf0f0b36a4";
    public const ROUTE_105 = "5949b454-0504-4bb7-b00b-2005cb10f390";
    public const ISLAND_CAVE = "80bebac6-261d-4903-a211-9f285092048a";
    public const ROUTE_106 = "1d06a12e-3a5a-49c9-b9e1-8c54220f41c0";
    public const GRANITE_CAVE = "f2d7ba2e-b19a-4446-9951-508ee136648a";
    public const GRANITE_CAVE_1F = "13450332-3d48-4ab6-a925-125de33b95f0";
    public const GRANITE_CAVE_B1F = "76a5c27e-16c7-4d6a-b68f-239ab4ad0ea8";
    public const GRANITE_CAVE_B2F = "e0be8bd3-78e2-41fb-bf75-c7c726bfc9c3";
    public const GRANITE_CAVE_STEVENS_ROOM = "175b2e59-a258-473d-be3d-0989ba488fbc";
    public const DEWFORD_TOWN = "d18916b5-b892-4815-9315-9316ab046a24";
    public const DEWFORD_GYM = "2e09bb0e-2b16-430d-bfff-887485a686ec";
    public const ROUTE_107 = "26c0dd8a-c347-46ef-a285-fc5776860035";
    public const ROUTE_108 = "e4588215-a355-4e4b-ab7d-4da3e86efc3c";
    public const ABANDONED_SHIP = "c4a9ecf6-e5df-4724-bebf-703a7e088bea";
    public const ABANDONED_SHIP_1F = "a669d6dc-dde8-46be-acc3-5666e19fb1dd";
    public const ABANDONED_SHIP_B1F = "32f13b3b-b4b7-4cf9-b4dc-400c9ecde195";
    public const ROUTE_109 = "d9c088ae-6ec6-43b3-aff3-9cc38b9412ed";
    public const SEASHORE_HOUSE = "3e5e26de-18e1-496f-8bff-291a46d62b81";
    public const SLATEPORT_CITY = "44be8c69-7949-465e-82ee-fc72e3460b51";
    public const SS_TIDAL = "bbd69872-6b9b-4b4d-af7a-b99b03ca7e27";
    public const OCEANIC_MUSEUM = "95d5fa35-0137-46a8-9308-f64ed4c45761";
    public const ROUTE_110 = "ca1ee608-fcae-4f8b-8173-6a9d2f20eaa4";
    public const MAUVILLE_CITY = "9a254063-bbc9-4d28-9a39-b07ce378be31";
    public const MAUVILLE_GYM = "d3540f7f-0525-418f-9a21-4ca0c7b95a62";
    public const ROUTE_111 = "35e66da0-01a5-4930-b444-a87eead8e0c2";
    public const WINSTRATE_FAMILY_HOME = "660f2f86-2fb0-42e5-a405-6f6935e012df";
    public const DESERT_RUINS = "653a94a5-8353-4ce4-aed1-e99a59106f06";
    public const MIRAGE_TOWER = "76303799-c2da-47d3-8266-b9c0938c7698";
    public const ROUTE_112 = "c49c33f6-da4c-435c-9394-154ae35cebe9";
    public const FIERY_PATH = "aea912d3-1549-4fa6-8980-5bbcb9222698";
    public const MT_CHIMNEY = "088a6b49-64ec-4eb0-ac31-cdb278f1f528";
    public const JAGGED_PASS = "c6d1d330-dc51-40c4-8d5d-adb1b59918f8";
    public const MAGMA_HIDEOUT = "86032ee3-6acb-453d-a19c-34cd61c67a71";
    public const MAGMA_HIDEOUT_1F = "5f7f724e-5a83-4b25-b221-47151efd762f";
    public const MAGMA_HIDEOUT_2F = "45bf3c3e-1634-468c-8a7e-201ecdcaf0d8";
    public const MAGMA_HIDEOUT_3F = "e4d26ea2-3e97-4a07-bbf6-e2328df9b7b5";
    public const MAGMA_HIDEOUT_4F = "1470a725-f859-40ed-b84a-5a916ecf93fe";
    public const MAGMA_HIDEOUT_5F = "d0e467f0-7885-4a28-b7f5-a203ddaef348";
    public const MAGMA_HIDEOUT_6F = "1c0d0e39-3565-4203-b1ae-19fd014280fb";
    public const LAVARIDGE_TOWN = "be84fcb3-a858-49ed-9915-a680daec2cae";
    public const LAVARIDGE_GYM = "7d2d886d-9af8-41d0-8373-a6a6ddd4affb";
    public const HOT_SPRINGS = "ede92219-0358-4ebd-a1ca-203c00241cc2";
    public const ROUTE_113 = "616b26d0-cf3a-45dd-972b-f5e3a6ff57cc";
    public const FALLARBOR_TOWN = "51719fe1-a3e5-4569-b8c1-95c9aaf385b7";
    public const ROUTE_114 = "16813710-8a49-47e4-b584-03a9608c031f";
    public const DESERT_UNDERPASS = "d2baf25e-209f-4af1-a1b1-bdac9dba6503";
    public const METEOR_FALLS = "510e6c74-2a33-4604-92b1-8af3dac07920";
    public const METEOR_FALLS_1F = "6979e54a-948e-465e-96c3-6f4633a3a6b2";
    public const METEOR_FALLS_B1F = "47409299-d5b2-4c0f-8ec1-b75934d22d3e";
    public const METEOR_FALLS_B2F = "84c7db37-7cc5-4c6f-908d-3f7f437cf1c7";
    public const METEOR_FALLS_STEVENS_CAVE = "721d187b-a4f8-42e4-b900-6353ce1d0458";
    public const ROUTE_115 = "2c8831f9-e1c3-4952-ac99-e056e4e333cb";
    public const VERDANTURF_TOWN = "f9382812-6762-4891-99a0-c8defbf62f08";
    public const ROUTE_117 = "fcd85adf-312b-4a20-a64b-a00a77208698";
    public const ROUTE_118 = "22d348c3-7bdf-416e-af64-c89ef48886d8";
    public const ROUTE_119 = "6d995161-4825-475d-a50c-595aa7732302";
    public const WEATHER_INSTITUTE = "7d6c3981-5717-4810-b778-510b7ce480bf";
    public const WEATHER_INSTITUTE_1F = "ce01ba03-f5d5-4d19-9e82-4ed38740ed60";
    public const WEATHER_INSTITUTE_2F = "1b699e71-5165-4112-ad0b-c1635d7ffb2a";
    public const FORTREE_CITY = "822ee222-fc75-48ec-9d23-19d6dfc37b66";
    public const FORTREE_GYM = "b76d6460-e16c-4a7e-8a4e-d5bfc825b526";
    public const ROUTE_120 = "9f7453bb-33d4-41c7-a214-a9504e2cfdf1";
    public const ANCIENT_TOMB = "b838eae1-908c-4445-a350-7d1d7bc62320";
    public const ROUTE_121 = "e5a9d2fe-30de-4e52-bc65-8b72b0cf5603";
    public const HOENN_SAFARI_ZONE = "abf0c1cf-e264-4e7c-97cb-d992efab1e85";
    public const HOENN_SAFARI_ZONE_AREA_1 = "5c621dac-18c3-4923-96c4-501055ab1cfb";
    public const HOENN_SAFARI_ZONE_AREA_2 = "dd9f8915-072e-4326-8524-65ee766e8260";
    public const HOENN_SAFARI_ZONE_AREA_3 = "2ba0660e-24e4-47cd-bbdf-225a3d1c1da9";
    public const HOENN_SAFARI_ZONE_AREA_4 = "59ab190e-da59-4002-84a4-5cb34bc6b159";
    public const HOENN_SAFARI_ZONE_AREA_5 = "f97de987-84c7-4462-9c8b-11d999379ebb";
    public const HOENN_SAFARI_ZONE_AREA_6 = "fc345628-c85b-4f52-b95e-73bd815b93a9";
    public const ROUTE_122 = "ba0cda18-9b88-469b-93d6-834679b157b3";
    public const MT_PYRE = "962be59f-1929-48f1-aaee-ba734a5f8ec6";
    public const MT_PYRE_EXTERIOR = "d5d572d1-c6e4-4da8-b941-edd22fc9d0b3";
    public const MT_PYRE_1F = "7c75a76d-109e-408c-b6a2-37d29822498f";
    public const MT_PYRE_2F = "ee0a45bd-ca89-45b2-b728-9dc39758309c";
    public const MT_PYRE_3F = "4a6adf00-1692-48d4-b70f-119018f5b04d";
    public const MT_PYRE_4F = "bf1fbf75-dc74-4982-8672-d376fd484851";
    public const MT_PYRE_5F = "cc7ee2b6-7358-4057-92f1-585963b58b26";
    public const MT_PYRE_6F = "13e3aadf-5160-442a-a0e6-b2be4bdda0d2";
    public const MT_PYRE_SUMMIT = "1e5a88e0-b007-42c2-9301-343b34353258";
    public const ROUTE_123 = "ac2a0b2f-121c-4cb4-b91a-c48515ee9101";
    public const LILYCOVE_CITY = "2a9568fa-1ff3-4dea-a22c-bce3df02e21f";
    public const AQUA_HIDEOUT = "fc42415a-0d6e-48ba-b4e8-9a592778f787";
    public const AQUA_HIDEOUT_1F = "b41441d4-996b-46a5-ba5c-6cc89ce39908";
    public const AQUA_HIDEOUT_B1F = "6266a370-8c62-4f96-aef0-1db6148600a0";
    public const AQUA_HIDEOUT_B2F = "66e32621-0cd4-4e27-9b66-085ea9927cbb";
    public const ROUTE_124 = "ea7754dc-334e-4eeb-9afe-a78194e1c55d";
    public const MOSSDEEP_CITY = "4ebeddf0-1b0c-4295-b082-0f382cd90ea6";
    public const MOSSDEEP_SPACE_CENTER = "5cf6e0ca-45c4-4474-8f79-c79e0c4e33cc";
    public const STEVENS_HOUSE = "bbc4bdab-035f-4aae-ab88-11da55fbae6d";
    public const MOSSDEEP_GYM = "47d581d1-5dba-49f5-b87d-27c37167f372";
    public const ROUTE_125 = "8fdb6cde-8b0a-4de4-a4b8-ad3d1317d311";
    public const SHOAL_CAVE = "83c06e92-1706-4f76-8875-00bd952cc841";
    public const SHOAL_CAVE_MAIN_CAVE = "120dd677-6bad-404b-9b73-a9f86ab535be";
    public const SHOAL_CAVE_ICE_ROOM = "d4d468c5-584f-4aaa-81dc-8fa30101b292";
    public const ROUTE_126 = "4176fd76-bd1d-48d7-bef8-0ab4d2cc8e2c";
    public const SOOTOPOLIS_CITY = "789b139b-e219-4dfd-80bb-f6f8673a32c4";
    public const CAVE_OF_ORIGIN = "c0d28b50-afc1-4992-9ee0-ea9ac89bdc81";
    public const SOOTOPOLIS_GYM = "c42c4569-fa89-4e59-a5c1-9a77d9f5f594";
    public const ROUTE_127 = "9ed3a5c7-211e-4f59-be1f-367a6abb9720";
    public const ROUTE_128 = "b3119749-d065-4bf8-926c-317c185fd89c";
    public const SEAFLOOR_CAVERN = "3677edcd-5af8-4555-b35a-fad1da4d62d4";
    public const ROUTE_129 = "786ea4c4-06bd-4110-8860-69a653572553";
    public const ROUTE_130 = "794177d2-d6c7-4c0a-af80-ebbd2995047b";
    public const ROUTE_131 = "e08f298a-63fe-4b9f-9d56-059142c443b8";
    public const SKY_PILLAR = "7e334a0e-001f-42b5-9946-76e1e6338a7e";
    public const SKY_PILLAR_1F = "f718f988-4a1f-4695-ab2c-d6cb420e69af";
    public const SKY_PILLAR_2F = "870586f9-b113-42d7-809d-4e8fe1ee9d3c";
    public const SKY_PILLAR_3F = "b2b2085e-b2bd-4887-974e-2b8df486f11a";
    public const SKY_PILLAR_4F = "8caf50f6-b116-40ba-a953-cce10ec7c3cc";
    public const SKY_PILLAR_5F = "2c481f70-b16a-4351-a8bb-8b137929fff6";
    public const SKY_PILLAR_APEX = "cb9f3ba3-a647-4fb0-86bb-8a840c032f43";
    public const PACIFIDLOG_TOWN = "a35df5e9-76f1-468d-9e59-0f49d62acbeb";
    public const ROUTE_132 = "7869e32a-4fa2-4945-a92f-2a1a086fd743";
    public const ROUTE_133 = "b0c12167-eb14-4f22-bc44-7c3d6dd9b7e2";
    public const ROUTE_134 = "24210846-de56-4a15-acfb-680e5fa095b3";
    public const EVER_GRANDE_CITY = "01bac875-a175-4c81-ac08-93c4ea7b4b1e";
    public const HOENN_VICTORY_ROAD = "e83f1bcf-4f8d-4572-8615-b583446abe8e";
    public const HOENN_VICTORY_ROAD_1F = "27191fb8-431d-4b9e-93d7-ebf5c3ea06a6";
    public const HOENN_VICTORY_ROAD_B1F = "726987bf-9869-45e6-9cab-d6f664d5fc6f";
    public const HOENN_VICTORY_ROAD_B2F = "49ce849f-21df-41be-9981-9237ffc50b2c";
    public const HOENN_POKEMON_LEAGUE = "fc2b1dca-ed65-4a81-b11f-b7e89890ed8f";
}