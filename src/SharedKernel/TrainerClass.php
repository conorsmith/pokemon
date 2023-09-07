<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\ItemId;
use LogicException;

final class TrainerClass
{
    public const BUG_CATCHER = "eeab339c-5159-451b-bc65-4b4ada50fcad";
    public const CAMPER = "7e944b8d-c8ee-4545-9391-c24b381f04a1";
    public const GYM_LEADER = "359c0b3f-e693-4260-8742-ff2f3ca09376";
    public const BLACK_BELT = "cb64d0f2-1bff-4c46-8c29-041f38927817";
    public const COOLTRAINER = "5c486678-1ba0-4a3f-87d1-71400ab9e482";
    public const TAMER = "d3089419-2049-4cd6-8d3b-a7068a2d09c7";
    public const LASS = "38d72f0d-6be9-47a3-a3f9-1d02b70790db";
    public const YOUNGSTER = "a125f3fc-687c-4b0f-94f0-66df16dd9b31";
    public const SUPER_NERD = "0b112d19-09bb-4e88-a224-d869dbbd4590";
    public const HIKER = "5bcdbc80-7550-42ab-90dc-037c8f374b97";
    public const TEAM_ROCKET_GRUNT = "ff58d913-28c6-4d64-b4bb-8fd986f1a2b4";
    public const SWIMMER = "73874300-c843-4be9-99b6-3d80cc92ba09";
    public const PICNICKER = "ce0ae171-cf0d-4d3d-973a-aca7ee1e3172";
    public const BEAUTY = "f753e0d0-2057-4a4f-bbcc-b47f2da2b1db";
    public const BIKER = "838721fe-87c1-4391-905d-c9328f3333dd";
    public const BIRD_KEEPER = "b44f398c-2a27-43e3-a97e-6413fe57ccd4";
    public const BURGLAR = "febb6ee5-4b22-4650-a54a-abaff370e583";
    public const CHAMPION = "5d06805f-6a83-45ac-ad69-3e1dcd86e750";
    public const CHANNELER = "21819ae8-6431-43f4-a50e-d65b6e582ee4";
    public const CUE_BALL = "1b95e805-c115-4cfb-85d9-3518b5ed94e1";
    public const ENGINEER = "04ac07df-4a78-4596-836a-f2a434e05970";
    public const FISHERMAN = "fd7754a8-d4a1-4d0a-a4a6-78f7eb33e118";
    public const GAMER = "4f4c492b-4547-4a49-a846-37a573830374";
    public const GENTLEMAN = "5232d715-df29-43e9-a27c-f9f4dfc38e16";
    public const JUGGLER = "6d3e71a5-d9b8-434c-acc2-70cdf01ff386";
    public const POKEMANIAC = "01b1cf69-0e82-4f94-83e7-7b8648429328";
    public const PSYCHIC = "e4e07fc8-34ca-4b47-9b15-d1c01e62d320";
    public const ROCKER = "5c0f48ed-1e5d-40d6-83a1-a0f3884126d7";
    public const ROCKET = "2b014071-514d-40a5-8c5e-892e32c61628";
    public const SAILOR = "fdb563e2-2c80-4ff5-9cad-ff0306fd3a15";
    public const SCIENTIST = "2f9bb77a-e87d-44be-af14-71f7db49accf";
    public const BOARDER = "442e116a-4daa-4aba-8c34-3d83b0dc94cb";
    public const FIREBREATHER = "ea662a0f-d2be-48c9-b516-16ecdb8f781b";
    public const GUITARIST = "111489eb-dc3e-43b2-b399-5d3b2c1e909f";
    public const KIMONO_GIRL = "62d49698-ea68-487b-acdb-7344cb4857a5";
    public const MEDIUM = "3094ad9e-41e4-489a-8428-befee691359a";
    public const OFFICER = "235c8a4e-9874-473b-9850-4ce58547c5a1";
    public const POKEFAN = "ea4d360f-56b1-4788-b21f-bd6e2f5616d3";
    public const POKEMON_TRAINER = "666739f6-b9a0-4933-ac3c-c6b5830dfe40";
    public const ROCKET_EXECUTIVE = "93c929bb-ae5b-4845-b4ae-4ff02e5a91ce";
    public const SAGE = "33f7b7d7-4789-4f02-82f4-a37169d98123";
    public const SCHOOL_KID = "5b92c021-0dd3-4e04-84da-aa9f221e05b4";
    public const SKIER = "f7c94641-736d-4f7c-a7af-76edaba38109";
    public const TEACHER = "47c446d5-bb1a-464f-b2ae-47d83d027d2c";
    public const TWINS = "ad6c87d9-79a9-4154-82b7-47a5b7ead092";
    public const MYSTICALMAN = "04a1e2a1-8fd1-44e7-ad44-d2e619f1d2c9";
    public const AQUA_ADMIN = "a0d9515f-32f8-4daa-a301-f5ad05c641b8";
    public const AQUA_LEADER = "ebc10234-3c6f-461a-b479-8facfd6d9b7c";
    public const AROMA_LADY = "803fa603-e2b4-4d78-bce0-ff960adf462c";
    public const BATTLE_GIRL = "20b53f65-d74f-4a9b-afb5-b838701c3d35";
    public const BUG_MANIAC = "76faa867-36e3-4d4c-b565-159b553f9f10";
    public const COLLECTOR = "f6cc23de-6d07-471d-99fa-c6fd7fc98c78";
    public const DRAGON_TAMER = "92997609-e76c-4b98-9bcb-cbd51c89a952";
    public const EXPERT = "8fe9edf8-a125-4ec4-8c8f-982eca448a89";
    public const HEX_MANIAC = "faf6e63b-d0e2-4512-9216-4e105e105099";
    public const INTERVIEWER = "5407c651-b764-467d-85d6-85775b66304f";
    public const KINDLER = "0069a5ca-e75b-44cf-a17b-ca9e5f90e0f8";
    public const LADY = "7e0f2219-ce4a-446b-b8ee-b225eddd822c";
    public const MAGMA_ADMIN = "92dd0682-db38-4a55-ae04-bde7b634a511";
    public const MAGMA_LEADER = "cc56af38-3ac3-44e0-9e6d-b894bf6f198d";
    public const NINJA_BOY = "b62b9eef-26d1-4b10-80d8-03a66eba6c25";
    public const OLD_COUPLE = "978da2c9-9adf-4996-9575-9ef5a3ba22b2";
    public const PARASOL_LADY = "7f7843e1-7670-432c-959e-3a4f896377c2";
    public const POKEMON_BREEDER = "2efd01b9-000b-41c0-8731-22e564d55dbe";
    public const POKEMON_RANGER = "ac4515e4-9083-4aaf-bae0-0da2cb2c5548";
    public const RICH_BOY = "b0a5cc13-4c15-42bb-aea7-97d6df10ea00";
    public const RUIN_MANIAC = "73d282d8-0c5f-4990-8f28-a673f53dd76d";
    public const SIS_AND_BRO = "7d6e3a85-8c59-4f2e-b2e8-f9f804a26ae2";
    public const TEAMMATES = "4e77aa7a-a4d5-4a6b-928a-e953e82a281a";
    public const TEAM_AQUA_GRUNT = "94d8a43a-910c-4855-8921-41c22138cd34";
    public const TEAM_MAGMA_GRUNT = "56bc71ff-6ece-450f-b9f6-c6082723b3e8";
    public const TRIATHLETE = "f3268518-d0f1-45a7-b731-3bfea6a82abf";
    public const TUBER = "65411fbb-d140-45e4-a328-596bab89b5e9";
    public const WINSTRATE = "55b9daa6-a5cd-44d0-a9aa-3cdab2cbcd34";
    public const YOUNG_COUPLE = "38624b0c-2376-4489-87cf-0f816ea50268";
    public const COOL_COUPLE = "ea694ae8-d1b7-49b7-960f-3df276257eb0";
    public const CRUSH_GIRL = "918c6749-b8f1-4523-b5b3-9c8e4de89602";
    public const CRUSH_KIN = "f1730617-4401-4bfc-97ea-10f82af1fcf0";
    public const PAINTER = "c58a9944-fc78-490c-b00a-905dab0536b8";
    public const TEAM_ROCKET_ADMIN = "efbbd054-7571-42b3-8fb5-a04d951b76fd";
    public const BOSS = "79bfa414-bdd4-4964-8a15-a4f581cf4137";
    public const ELITE_FOUR = "a5bf9ec9-effe-4a22-b4c8-a9c89a7b6481";
    public const RETIRED_TRAINER = "cb2b9587-8dd5-4570-a3f7-d5dcf4be7c32";
    public const ELDER = "69624863-15ca-44b1-839c-0591f03ee7f6";
    public const RIVAL = "7e87dafe-b95e-4ca7-9f30-d37aa1bb51f8";
    public const DOUBLE_TEAM = "8f741e23-4115-491d-b526-5ef4966183f6";
    public const FAIRY_TALE_GIRL = "22f343d7-dd1a-4d1b-b634-4ddb0292753b";
    public const MYSTERIOUS_SISTERS = "22f343d7-dd1a-4d1b-b634-4ddb0292753b";
    public const BACKPACKER = "b05a7721-a380-4fd7-a3dc-0c4045acd835";

    public static function getLabel(string $id): string
    {
        return match ($id) {
            self::BUG_CATCHER       => "Bug Catcher",
            self::CAMPER            => "Camper",
            self::GYM_LEADER        => "Gym Leader",
            self::BLACK_BELT        => "Black Belt",
            self::COOLTRAINER       => "Cooltrainer",
            self::TAMER             => "Tamer",
            self::LASS              => "Lass",
            self::YOUNGSTER         => "Youngster",
            self::SUPER_NERD        => "Super Nerd",
            self::HIKER             => "Hiker",
            self::TEAM_ROCKET_GRUNT => "Team Rocket Grunt",
            self::SWIMMER           => "Swimmer",
            self::PICNICKER         => "Picnicker",
            self::BEAUTY            => "Beauty",
            self::BIKER             => "Biker",
            self::BIRD_KEEPER       => "Bird Keeper",
            self::BURGLAR           => "Burglar",
            self::CHAMPION          => "Champion",
            self::CHANNELER         => "Channeler",
            self::CUE_BALL          => "Cue Ball",
            self::ENGINEER          => "Engineer",
            self::FISHERMAN         => "Fisherman",
            self::GAMER             => "Gamer",
            self::GENTLEMAN         => "Gentleman",
            self::JUGGLER           => "Juggler",
            self::POKEMANIAC        => "PokéManiac",
            self::PSYCHIC           => "Psychic",
            self::ROCKER            => "Rocker",
            self::ROCKET            => "Rocket",
            self::SAILOR            => "Sailor",
            self::SCIENTIST         => "Scientist",
            self::BOARDER           => "Boarder",
            self::FIREBREATHER      => "Firebreather",
            self::GUITARIST         => "Guitarist",
            self::KIMONO_GIRL       => "Kimono Girl",
            self::MEDIUM            => "Medium",
            self::OFFICER           => "Police Officer",
            self::POKEFAN           => "Pokéfan",
            self::POKEMON_TRAINER   => "Pokémon Trainer",
            self::ROCKET_EXECUTIVE  => "Rocket Executive",
            self::SAGE              => "Sage",
            self::SCHOOL_KID        => "School Kid",
            self::SKIER             => "Skier",
            self::TEACHER           => "Teacher",
            self::TWINS             => "Twins",
            self::MYSTICALMAN       => "Mysticalman",
            self::AQUA_ADMIN        => "Aqua Admin",
            self::AQUA_LEADER       => "Aqua Leader",
            self::AROMA_LADY        => "Aroma Lady",
            self::BATTLE_GIRL       => "Battle Girl",
            self::BUG_MANIAC        => "Bug Maniac",
            self::COLLECTOR         => "Collector",
            self::DRAGON_TAMER      => "Dragon Tamer",
            self::EXPERT            => "Expert",
            self::HEX_MANIAC        => "Hex Maniac",
            self::INTERVIEWER       => "Interviewer",
            self::KINDLER           => "Kindler",
            self::LADY              => "Lady",
            self::MAGMA_ADMIN       => "Magma Admin",
            self::MAGMA_LEADER      => "Magma Leader",
            self::NINJA_BOY         => "Ninja Boy",
            self::OLD_COUPLE        => "Old Couple",
            self::PARASOL_LADY      => "Parasol Lady",
            self::POKEMON_BREEDER   => "Pokémon Breeder",
            self::POKEMON_RANGER    => "Pokémon Ranger",
            self::RICH_BOY          => "Rich Boy",
            self::RUIN_MANIAC       => "Ruin Maniac",
            self::SIS_AND_BRO       => "Sis and Bro",
            self::TEAMMATES         => "Teammates",
            self::TEAM_AQUA_GRUNT   => "Team Aqua Grunt",
            self::TEAM_MAGMA_GRUNT  => "Team Magma Grunt",
            self::TRIATHLETE        => "Triathlete",
            self::TUBER             => "Tuber",
            self::WINSTRATE         => "Winstrate",
            self::YOUNG_COUPLE      => "Young Couple",
            self::COOL_COUPLE       => "Cool Couple",
            self::CRUSH_GIRL        => "Crush Girl",
            self::CRUSH_KIN         => "Crush Kin",
            self::PAINTER           => "Painter",
            self::TEAM_ROCKET_ADMIN => "Team Rocket Admin",
            self::BOSS              => "Boss",
            self::ELITE_FOUR        => "Elite Four",
            self::RETIRED_TRAINER   => "Retired Trainer",
            self::ELDER             => "Elder",
            self::DOUBLE_TEAM       => "Double Team",
            default                 => throw new LogicException(),
        };
    }

    public static function getImageUrl(string $id, Gender $gender = Gender::IMMATERIAL): ?string
    {
        return match($id) {
            self::BUG_CATCHER       => "https://archives.bulbagarden.net/media/upload/b/b9/Spr_FRLG_Bug_Catcher.png",
            self::CAMPER            => "https://archives.bulbagarden.net/media/upload/2/23/Spr_FRLG_Camper.png",
            self::GYM_LEADER        => null,
            self::BLACK_BELT        => "https://archives.bulbagarden.net/media/upload/8/8e/Spr_FRLG_Black_Belt.png",
            self::COOLTRAINER       => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/7/7f/Spr_FRLG_Cooltrainer_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/b/b8/Spr_FRLG_Cooltrainer_M.png",
                default        => null,
            },
            self::TAMER             => "https://archives.bulbagarden.net/media/upload/8/89/Spr_FRLG_Tamer.png",
            self::LASS              => "https://archives.bulbagarden.net/media/upload/4/46/Spr_FRLG_Lass.png",
            self::YOUNGSTER         => "https://archives.bulbagarden.net/media/upload/d/d5/Spr_FRLG_Youngster.png",
            self::SUPER_NERD        => "https://archives.bulbagarden.net/media/upload/1/1f/Spr_FRLG_Super_Nerd.png",
            self::HIKER             => "https://archives.bulbagarden.net/media/upload/8/8c/Spr_FRLG_Hiker.png",
            self::TEAM_ROCKET_GRUNT => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/6/68/Spr_FRLG_Team_Rocket_Grunt_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/8/85/Spr_FRLG_Team_Rocket_Grunt_M.png",
                default        => "https://archives.bulbagarden.net/media/upload/8/85/Spr_FRLG_Team_Rocket_Grunt_M.png",
            },
            self::TEAM_ROCKET_ADMIN => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/6/68/Spr_FRLG_Team_Rocket_Grunt_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/8/85/Spr_FRLG_Team_Rocket_Grunt_M.png",
                default        => null,
            },
            self::SWIMMER           => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/4/4d/Spr_FRLG_Swimmer_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/9/95/Spr_FRLG_Swimmer_M.png",
                default        => null,
            },
            self::PICNICKER         => "https://archives.bulbagarden.net/media/upload/a/a0/Spr_FRLG_Picnicker.png",
            self::SAILOR            => "https://archives.bulbagarden.net/media/upload/a/a1/Spr_FRLG_Sailor.png",
            self::ENGINEER          => "https://archives.bulbagarden.net/media/upload/7/71/Spr_FRLG_Engineer.png",
            self::GENTLEMAN         => "https://archives.bulbagarden.net/media/upload/9/94/Spr_FRLG_Gentleman.png",
            self::FISHERMAN         => match($gender) {
                Gender::MALE => "https://archives.bulbagarden.net/media/upload/c/c7/Spr_FRLG_Fisherman.png",
                default      => "https://archives.bulbagarden.net/media/upload/c/c7/Spr_FRLG_Fisherman.png",
            },
            self::GAMER             => "https://archives.bulbagarden.net/media/upload/1/1e/Spr_FRLG_Gamer.png",
            self::POKEMANIAC        => "https://archives.bulbagarden.net/media/upload/0/0e/Spr_FRLG_Pok%C3%A9Maniac.png",
            self::CHANNELER         => "https://archives.bulbagarden.net/media/upload/1/1e/Spr_FRLG_Channeler.png",
            self::TWINS             => "https://archives.bulbagarden.net/media/upload/a/ab/Spr_FRLG_Twins.png",
            self::BIKER             => "https://archives.bulbagarden.net/media/upload/6/6e/Spr_FRLG_Biker.png",
            self::BOSS              => "https://archives.bulbagarden.net/media/upload/4/41/Spr_FRLG_Giovanni.png",
            self::YOUNG_COUPLE      => "https://archives.bulbagarden.net/media/upload/2/2b/Spr_FRLG_Young_Couple.png",
            self::CUE_BALL          => "https://archives.bulbagarden.net/media/upload/1/19/Spr_FRLG_Cue_Ball.png",
            self::BIRD_KEEPER       => "https://archives.bulbagarden.net/media/upload/b/b2/Spr_FRLG_Bird_Keeper.png",
            self::ROCKER            => "https://archives.bulbagarden.net/media/upload/f/f3/Spr_FRLG_Rocker.png",
            self::BEAUTY            => "https://archives.bulbagarden.net/media/upload/3/39/Spr_FRLG_Beauty.png",
            self::CRUSH_KIN         => "https://archives.bulbagarden.net/media/upload/c/cc/Spr_FRLG_Crush_Kin.png",
            self::JUGGLER           => "https://archives.bulbagarden.net/media/upload/5/50/Spr_FRLG_Juggler.png",
            self::PSYCHIC           => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/6/6b/Spr_RS_Psychic_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/e/ea/Spr_FRLG_Psychic_M.png",
                default        => null,
            },
            self::SCIENTIST         => "https://archives.bulbagarden.net/media/upload/f/f9/Spr_FRLG_Scientist.png",
            self::SIS_AND_BRO       => "https://archives.bulbagarden.net/media/upload/9/94/Spr_FRLG_Sis_and_Bro.png",
            self::BURGLAR           => "https://archives.bulbagarden.net/media/upload/7/78/Spr_FRLG_Burglar.png",
            self::COOL_COUPLE       => "https://archives.bulbagarden.net/media/upload/c/cf/Spr_FRLG_Cool_Couple.png",
            self::CRUSH_GIRL        => "https://archives.bulbagarden.net/media/upload/d/dc/Spr_FRLG_Crush_Girl.png",
            self::POKEMON_RANGER    => match($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/7/76/Spr_FRLG_Pok%C3%A9mon_Ranger_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/0/0d/Spr_FRLG_Pok%C3%A9mon_Ranger_M.png",
                default        => null,
            },
            self::AROMA_LADY        => "https://archives.bulbagarden.net/media/upload/f/f9/Spr_FRLG_Aroma_Lady.png",
            self::TUBER             => "https://archives.bulbagarden.net/media/upload/8/89/Spr_FRLG_Tuber.png",
            self::POKEMON_BREEDER   => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/a/a8/Spr_RS_Pok%C3%A9mon_Breeder_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/5/55/Spr_RS_Pok%C3%A9mon_Breeder_M.png",
                default        => null,
            },
            self::PAINTER           => "https://archives.bulbagarden.net/media/upload/b/bd/Spr_FRLG_Painter.png",
            self::LADY              => "https://archives.bulbagarden.net/media/upload/9/91/Spr_FRLG_Lady.png",
            self::RUIN_MANIAC       => "https://archives.bulbagarden.net/media/upload/8/81/Spr_FRLG_Ruin_Maniac.png",
            self::SAGE              => "https://archives.bulbagarden.net/media/upload/0/07/Spr_HGSS_Sage.png",
            self::FIREBREATHER      => "https://archives.bulbagarden.net/media/upload/a/a7/Spr_HGSS_Firebreather.png",
            self::POKEFAN           => match($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/6/63/Spr_RS_Pok%C3%A9fan_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/a/a3/Spr_RS_Pok%C3%A9fan_M.png",
                default        => null,
            },
            self::OFFICER           => "https://archives.bulbagarden.net/media/upload/0/0d/Spr_DP_Officer.png",
            self::SCHOOL_KID        => "https://archives.bulbagarden.net/media/upload/f/f4/Spr_HGSS_School_Kid.png",
            self::MEDIUM            => "https://archives.bulbagarden.net/media/upload/5/56/Spr_HGSS_Medium.png",
            self::KIMONO_GIRL       => "https://archives.bulbagarden.net/media/upload/0/01/Spr_HGSS_Kimono_Girl.png",
            self::GUITARIST         => "https://archives.bulbagarden.net/media/upload/1/14/Spr_RS_Guitarist.png",
            self::TEACHER           => "https://archives.bulbagarden.net/media/upload/a/ab/Spr_HGSS_Teacher.png",
            self::MYSTICALMAN       => "https://archives.bulbagarden.net/media/upload/4/4a/Spr_HGSS_Eusine.png",
            self::DOUBLE_TEAM       => "https://archives.bulbagarden.net/media/upload/2/28/Spr_HGSS_Double_Team.png",
            self::SKIER             => "https://archives.bulbagarden.net/media/upload/4/41/Spr_HGSS_Skier.png",
            self::BOARDER           => "https://archives.bulbagarden.net/media/upload/4/42/Spr_HGSS_Boarder.png",
            self::TEAM_MAGMA_GRUNT  => match($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/0/03/Spr_RS_Team_Magma_Grunt_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/a/a0/Spr_RS_Team_Magma_Grunt_M.png",
                default        => null,
            },
            self::TEAM_AQUA_GRUNT   => "https://archives.bulbagarden.net/media/upload/7/74/Spr_RS_Team_Aqua_Grunt_M.png",
            self::RICH_BOY          => "https://archives.bulbagarden.net/media/upload/d/d7/Spr_RS_Rich_Boy.png",
            self::BATTLE_GIRL       => "https://archives.bulbagarden.net/media/upload/5/54/Spr_RS_Battle_Girl.png",
            self::COLLECTOR         => "https://archives.bulbagarden.net/media/upload/2/28/Spr_RS_Collector.png",
            self::INTERVIEWER       => "https://archives.bulbagarden.net/media/upload/5/5e/Spr_RS_Interviewer.png",
            self::MAGMA_ADMIN       => "https://archives.bulbagarden.net/media/upload/5/51/Spr_RS_Tabitha.png",
            self::MAGMA_LEADER      => "https://archives.bulbagarden.net/media/upload/e/e3/Spr_RS_Maxie.png",
            self::AQUA_ADMIN        => "https://archives.bulbagarden.net/media/upload/d/d0/Spr_RS_Matt.png",
            self::AQUA_LEADER       => "https://archives.bulbagarden.net/media/upload/f/fe/Spr_RS_Archie.png",
            self::EXPERT            => "https://archives.bulbagarden.net/media/upload/6/66/Spr_RS_Expert_F.png",
            self::KINDLER           => "https://archives.bulbagarden.net/media/upload/0/07/Spr_RS_Kindler.png",
            self::NINJA_BOY         => "https://archives.bulbagarden.net/media/upload/b/bc/Spr_RS_Ninja_Boy.png",
            self::PARASOL_LADY      => "https://archives.bulbagarden.net/media/upload/e/ea/Spr_RS_Parasol_Lady.png",
            self::TEAMMATES         => "https://archives.bulbagarden.net/media/upload/7/70/Spr_RS_Sr_and_Jr.png",
            self::OLD_COUPLE        => "https://archives.bulbagarden.net/media/upload/0/06/Spr_RS_Old_Couple.png",
            self::DRAGON_TAMER      => "https://archives.bulbagarden.net/media/upload/1/12/Spr_RS_Dragon_Tamer.png",
            self::TRIATHLETE        => match ($gender) {
                Gender::FEMALE => "https://archives.bulbagarden.net/media/upload/2/21/Spr_RS_Triathlete_Runner_F.png",
                Gender::MALE   => "https://archives.bulbagarden.net/media/upload/8/8d/Spr_RS_Triathlete_Runner_M.png",
                default        => null,
            },
            self::BUG_MANIAC        => "https://archives.bulbagarden.net/media/upload/4/4f/Spr_RS_Bug_Maniac.png",
            self::HEX_MANIAC        => "https://archives.bulbagarden.net/media/upload/3/3d/Spr_RS_Hex_Maniac.png",
            default                 => null,
        };
    }

    public static function hasUltraBallInPrizePool(string $id): bool
    {
        return in_array($id, [
            self::GYM_LEADER,
            self::BLACK_BELT,
            self::COOLTRAINER,
            self::TAMER,
            self::SUPER_NERD,
            self::BIKER,
            self::CHAMPION,
            self::ENGINEER,
            self::GENTLEMAN,
            self::POKEMANIAC,
            self::SCIENTIST,
            self::OFFICER,
            self::POKEMON_TRAINER,
            self::ROCKET_EXECUTIVE,
            self::SAGE,
            self::MYSTICALMAN,
            self::AQUA_ADMIN,
            self::AQUA_LEADER,
            self::BATTLE_GIRL,
            self::COLLECTOR,
            self::DRAGON_TAMER,
            self::EXPERT,
            self::LADY,
            self::MAGMA_ADMIN,
            self::MAGMA_LEADER,
            self::POKEMON_BREEDER,
            self::POKEMON_RANGER,
            self::RICH_BOY,
            self::COOL_COUPLE,
            self::TEAM_ROCKET_ADMIN,
            self::BOSS,
            self::ELITE_FOUR,
            self::RETIRED_TRAINER,
        ]);
    }

    public static function getAdditionalPrizePoolItems(string $id): array
    {
        return match($id) {
            self::AROMA_LADY      => [ItemId::SHINY_STONE],
            self::BEAUTY          => [ItemId::ICE_STONE],
            self::BIKER           => [ItemId::THUNDER_STONE],
            self::BLACK_BELT      => [ItemId::PROTECTOR],
            self::CAMPER          => [ItemId::LEAF_STONE],
            self::CHANNELER       => [ItemId::REAPER_CLOTH],
            self::COOLTRAINER     => [ItemId::DRAGON_SCALE, ItemId::KINGS_ROCK, ItemId::METAL_COAT],
            self::CUE_BALL        => [ItemId::FIRE_STONE],
            self::ENGINEER        => [ItemId::THUNDER_STONE],
            self::FISHERMAN       => [ItemId::WATER_STONE, ItemId::DEEP_SEA_TOOTH],
            self::HIKER           => [ItemId::MOON_STONE],
            self::LASS            => [ItemId::SUN_STONE],
            self::PICNICKER       => [ItemId::LEAF_STONE],
            self::POKEMANIAC      => [ItemId::ELECTIRIZER, ItemId::MAGMARIZER],
            self::POKEMON_BREEDER => [ItemId::PRISM_SCALE],
            self::POKEMON_RANGER  => [ItemId::DAWN_STONE, ItemId::DUSK_STONE],
            self::PSYCHIC         => [ItemId::SUN_STONE],
            self::RUIN_MANIAC     => [ItemId::RAZOR_FANG, ItemId::RAZOR_CLAW],
            self::SAILOR          => [ItemId::WATER_STONE, ItemId::DEEP_SEA_SCALE],
            self::SCIENTIST       => [ItemId::UPGRADE, ItemId::DUBIOUS_DISC],
            self::SUPER_NERD      => [ItemId::LINKING_CORD],
            self::SWIMMER         => [ItemId::WATER_STONE],
            self::TAMER           => [ItemId::BLACK_AUGURITE, ItemId::PEAT_BLOCK],
            default               => [],
        };
    }

    public static function getWeightedDistributionForIvs(string $id): ?array
    {
        return match($id) {
            self::GYM_LEADER,
            self::CHAMPION,
            self::ROCKET_EXECUTIVE,
            self::BOSS,
            self::TEAM_ROCKET_ADMIN,
            self::AQUA_ADMIN,
            self::AQUA_LEADER,
            self::MAGMA_ADMIN,
            self::MAGMA_LEADER,
            self::ELITE_FOUR,
            self::RETIRED_TRAINER,
            => [
                0  => 0,
                1  => 1,
                2  => 2,
                3  => 4,
                4  => 8,
                5  => 16,
                6  => 32,
                7  => 64,
                8  => 64,
                9  => 64,
                10 => 64,
                11 => 64,
                12 => 64,
                13 => 64,
                14 => 64,
                15 => 64,
                16 => 64,
                17 => 64,
                18 => 96,
                19 => 112,
                20 => 120,
                21 => 124,
                22 => 126,
                23 => 127,
                24 => 128,
                25 => 127,
                26 => 126,
                27 => 124,
                28 => 120,
                29 => 112,
                30 => 96,
                31 => 64,
            ],
            self::COOLTRAINER,
            self::COOL_COUPLE,
            self::POKEMON_BREEDER,
            self::DRAGON_TAMER,
            => [
                0  => 64,
                1  => 64,
                2  => 64,
                3  => 64,
                4  => 64,
                5  => 64,
                6  => 64,
                7  => 64,
                8  => 64,
                9  => 64,
                10 => 96,
                11 => 112,
                12 => 120,
                13 => 124,
                14 => 126,
                15 => 127,
                16 => 128,
                17 => 127,
                18 => 126,
                19 => 124,
                20 => 120,
                21 => 112,
                22 => 96,
                23 => 64,
                24 => 64,
                25 => 64,
                26 => 64,
                27 => 64,
                28 => 64,
                29 => 64,
                30 => 64,
                31 => 64,
            ],
            default => null,
        };
    }
}
