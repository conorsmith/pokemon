<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use Exception;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

final class RandomTrainerGenerator
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
    ) {}

    public function generate(int $opponentHighestLevel, string $locationId): Trainer
    {
        $faker = Factory::create();

        $trainerId = Uuid::uuid4()->toString();

        $trainerClass = RandomTrainerGenerator::randomlyGenerateTrainerClass();

        $anchorLevel = RandomNumberGenerator::generateInRange(
            $opponentHighestLevel - 10,
            $opponentHighestLevel + 10,
        );

        $party = [];

        $partySize = RandomNumberGenerator::generateFromWeightedTable([
            4 => 1,
            5 => 4,
            6 => 1,
        ]);

        RandomNumberGenerator::setSeed(crc32($trainerId));

        for ($i = 0; $i < $partySize; $i++) {
            $party[] = $this->randomlyGeneratePokemon($trainerClass, $anchorLevel);
        }

        RandomNumberGenerator::unsetSeed();

        return new Trainer(
            $trainerId,
            $faker->firstName,
            $trainerClass,
            match (RandomNumberGenerator::generateInRange(0, 2)) {
                0 => Gender::MALE,
                1 => Gender::FEMALE,
                2 => Gender::IMMATERIAL,
            },
            $party,
            $locationId,
            true,
            null,
        );
    }

    private function randomlyGeneratePokemon(string $trainerClass, int $anchorLevel): Pokemon
    {
        $pokedexNumber = $this->findRandomPokedexNumber($trainerClass);

        $level = RandomNumberGenerator::generateInRange(
            intval(floor($anchorLevel * 0.9)),
            intval(ceil($anchorLevel * 1.1)),
        );

        $pokedexEntry = $this->pokedexConfigRepository->find($pokedexNumber);

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $pokedexNumber,
            null,
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $level,
            255,
            match (RandomNumberGenerator::generateInRange(0, 2)) {
                0 => Sex::MALE,
                1 => Sex::FEMALE,
                2 => Sex::UNKNOWN,
            },
            RandomNumberGenerator::generateInRange(0, 4095) === 0,
            self::createStats($trainerClass, $level, $pokedexNumber),
            0,
            false,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        return $pokemon;
    }

    private function findRandomPokedexNumber(string $trainerClass): string
    {
        $pokedexNumbers = match ($trainerClass) {
            TrainerClass::BEAUTY => [
                PokedexNo::ODDISH,
                PokedexNo::BELLSPROUT,
                PokedexNo::PIDGEY,
                PokedexNo::PIDGEOTTO,
                PokedexNo::PIDGEOT,
                PokedexNo::JIGGLYPUFF,
                PokedexNo::WIGGLYTUFF,
                PokedexNo::RATTATA,
                PokedexNo::PIKACHU,
                PokedexNo::EXEGGCUTE,
                PokedexNo::NIDORAN_F,
                PokedexNo::BULBASAUR,
                PokedexNo::IVYSAUR,
                PokedexNo::CLEFAIRY,
                PokedexNo::CLEFABLE,
                PokedexNo::MEOWTH,
                PokedexNo::PERSIAN,
                PokedexNo::IGGLYBUFF,
                PokedexNo::PICHU,
                PokedexNo::CLEFFA,
                PokedexNo::AZURILL,
                PokedexNo::MARILL,
                PokedexNo::AZURILL,
                PokedexNo::GOLDEEN,
                PokedexNo::WAILMER,
                PokedexNo::KECLEON,
                PokedexNo::SEVIPER,
                PokedexNo::LOMBRE,
                PokedexNo::SHROOMISH,
                PokedexNo::NUMEL,
                PokedexNo::HORSEA,
                PokedexNo::LUVDISC,
            ],
            TrainerClass::BIKER => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::POISON)),
            ),
            TrainerClass::BIRD_KEEPER => [
                PokedexNo::PIDGEY,
                PokedexNo::PIDGEOTTO,
                PokedexNo::PIDGEOT,
                PokedexNo::SPEAROW,
                PokedexNo::FEAROW,
                PokedexNo::PSYDUCK,
                PokedexNo::GOLDUCK,
                PokedexNo::FARFETCH_D,
                PokedexNo::DODUO,
                PokedexNo::DODRIO,
                PokedexNo::ARTICUNO,
                PokedexNo::ZAPDOS,
                PokedexNo::MOLTRES,
                PokedexNo::HOOTHOOT,
                PokedexNo::NOCTOWL,
                PokedexNo::NATU,
                PokedexNo::XATU,
                PokedexNo::MURKROW,
                PokedexNo::DELIBIRD,
                PokedexNo::LUGIA,
                PokedexNo::HO_OH,
                PokedexNo::TORCHIC,
                PokedexNo::COMBUSKEN,
                PokedexNo::BLAZIKEN,
                PokedexNo::TAILLOW,
                PokedexNo::SWELLOW,
                PokedexNo::WINGULL,
                PokedexNo::PELIPPER,
                PokedexNo::SWABLU,
                PokedexNo::ALTARIA,
            ],
            TrainerClass::BLACK_BELT => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::BUG_CATCHER => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::BUG)),
            TrainerClass::BURGLAR => array_merge(
                [
                    PokedexNo::KOFFING,
                    PokedexNo::WEEZING,
                ],
                $this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE),
            ),
            TrainerClass::CHANNELER => [
                PokedexNo::GASTLY,
                PokedexNo::HAUNTER,
                PokedexNo::GENGAR,
            ],
            TrainerClass::COOLTRAINER => [
                PokedexNo::VENUSAUR,
                PokedexNo::TYRANITAR,
                PokedexNo::CLEFAIRY,
                PokedexNo::JIGGLYPUFF,
                PokedexNo::PERSIAN,
                PokedexNo::DEWGONG,
                PokedexNo::CHANSEY,
                PokedexNo::STARMIE,
                PokedexNo::KINGDRA,
                PokedexNo::BELLSPROUT,
                PokedexNo::WEEPINBELL,
                PokedexNo::VICTREEBEL,
                PokedexNo::PARAS,
                PokedexNo::PARASECT,
                PokedexNo::KINGLER,
                PokedexNo::POLIWRATH,
                PokedexNo::TENTACRUEL,
                PokedexNo::SEADRA,
                PokedexNo::BLASTOISE,
                PokedexNo::EXEGGUTOR,
                PokedexNo::SANDSLASH,
                PokedexNo::CLOYSTER,
                PokedexNo::ELECTRODE,
                PokedexNo::ARCANINE,
                PokedexNo::LAPRAS,
                PokedexNo::RHYDON,
                PokedexNo::SLOWBRO,
                PokedexNo::URSARING,
                PokedexNo::MACHOKE,
                PokedexNo::KANGASKHAN,
                PokedexNo::MACHAMP,
                PokedexNo::ODDISH,
                PokedexNo::GLOOM,
                PokedexNo::IVYSAUR,
                PokedexNo::NINETALES,
                PokedexNo::RAPIDASH,
                PokedexNo::GIRAFARIG,
                PokedexNo::PONYTA,
                PokedexNo::VULPIX,
                PokedexNo::RATICATE,
                PokedexNo::WARTORTLE,
                PokedexNo::CHARMELEON,
                PokedexNo::CHARIZARD,
                PokedexNo::RHYHORN,
                PokedexNo::NIDORINO,
                PokedexNo::NIDOKING,
                PokedexNo::MAROWAK,
                PokedexNo::NIDORINA,
                PokedexNo::NIDOQUEEN,
                PokedexNo::GRAVELER,
                PokedexNo::ONIX,
                PokedexNo::MAGNETON,
                PokedexNo::QUAGSIRE,
                PokedexNo::EXEGGCUTE,
                PokedexNo::BUTTERFREE,
                PokedexNo::BELLOSSOM,
                PokedexNo::POLIWHIRL,
                PokedexNo::FLAREON,
                PokedexNo::VAPOREON,
                PokedexNo::JOLTEON,
                PokedexNo::GOLDEEN,
                PokedexNo::SEAKING,
                PokedexNo::PARASECT,
                PokedexNo::GOLDUCK,
                PokedexNo::SKIPLOOM,
                PokedexNo::DRATINI,
                PokedexNo::DRAGONAIR,
                PokedexNo::DRAGONITE,
                PokedexNo::ELECTABUZZ,
                PokedexNo::TAUROS,
                PokedexNo::TANGELA,
                PokedexNo::MANECTRIC,
                PokedexNo::MUK,
                PokedexNo::AZUMARILL,
                PokedexNo::ZANGOOSE,
                PokedexNo::PELIPPER,
                PokedexNo::CAMERUPT,
                PokedexNo::ROSELIA,
                PokedexNo::MAWILE,
                PokedexNo::SABLEYE,
                PokedexNo::SWELLOW,
                PokedexNo::TRAPINCH,
                PokedexNo::WAILMER,
                PokedexNo::SHIFTRY,
                PokedexNo::CACTURNE,
                PokedexNo::LAIRON,
                PokedexNo::LINOONE,
                PokedexNo::MILOTIC,
                PokedexNo::DELCATTY,
                PokedexNo::NOSEPASS,
                PokedexNo::MEDICHAM,
                PokedexNo::LUDICOLO,
                PokedexNo::KECLEON,
                PokedexNo::LOUDRED,
                PokedexNo::DODRIO,
                PokedexNo::KADABRA,
                PokedexNo::CLAYDOL,
                PokedexNo::SHARPEDO,
                PokedexNo::MAGCARGO,
                PokedexNo::HARIYAMA,
            ],
            TrainerClass::CUE_BALL => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::ENGINEER => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ELECTRIC)),
            TrainerClass::FISHERMAN => [
                PokedexNo::POLIWAG,
                PokedexNo::TENTACOOL,
                PokedexNo::TENTACRUEL,
                PokedexNo::SHELLDER,
                PokedexNo::CLOYSTER,
                PokedexNo::KRABBY,
                PokedexNo::KINGLER,
                PokedexNo::HORSEA,
                PokedexNo::SEADRA,
                PokedexNo::GOLDEEN,
                PokedexNo::SEAKING,
                PokedexNo::STARYU,
                PokedexNo::STARMIE,
                PokedexNo::MAGIKARP,
                PokedexNo::GYARADOS,
                PokedexNo::CHINCHOU,
                PokedexNo::LANTURN,
                PokedexNo::QWILFISH,
                PokedexNo::CORSOLA,
                PokedexNo::REMORAID,
                PokedexNo::OCTILLERY,
                PokedexNo::MANTINE,
                PokedexNo::KINGDRA,
                PokedexNo::CARVANHA,
                PokedexNo::SHARPEDO,
                PokedexNo::WAILMER,
                PokedexNo::WAILORD,
                PokedexNo::BARBOACH,
                PokedexNo::WHISCASH,
                PokedexNo::FEEBAS,
                PokedexNo::MILOTIC,
                PokedexNo::CLAMPERL,
                PokedexNo::HUNTAIL,
                PokedexNo::GOREBYSS,
                PokedexNo::RELICANTH,
                PokedexNo::LUVDISC,
                PokedexNo::KYOGRE,
            ],
            TrainerClass::GAMER => [],
            TrainerClass::GENTLEMAN => [],
            TrainerClass::HIKER => [],
            TrainerClass::CAMPER => [],
            TrainerClass::PICNICKER => [],
            TrainerClass::JUGGLER => [],
            TrainerClass::LASS => [],
            TrainerClass::POKEMANIAC => [],
            TrainerClass::PSYCHIC => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::PSYCHIC)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::GHOST)),
            ),
            TrainerClass::GUITARIST => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ELECTRIC)),
            TrainerClass::TEAM_ROCKET_GRUNT => [],
            TrainerClass::SAILOR => [],
            TrainerClass::SCIENTIST => [],
            TrainerClass::SUPER_NERD => [],
            TrainerClass::SWIMMER => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
            TrainerClass::TAMER => [],
            TrainerClass::YOUNGSTER => [],
            default => array_keys($this->pokedexConfigRepository->all()),
        };

        if ($pokedexNumbers === []) {
            return PokedexNo::MAGIKARP;
        }

        $randomPokedexEntryKey = RandomNumberGenerator::generateInRange(0, count($pokedexNumbers) - 1);
        return strval($pokedexNumbers[$randomPokedexEntryKey]);
    }

    private static function createStats(string $trainerClass, int $level, string $number): Stats
    {
        $baseStats = self::findBaseStats($number);

        return new Stats(
            $level,
            $baseStats['hp'],
            $baseStats['attack'],
            $baseStats['defence'],
            $baseStats['spAttack'],
            $baseStats['spDefence'],
            $baseStats['speed'],
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            self::generateIv($trainerClass),
            0,
            0,
            0,
            0,
            0,
            0,
        );
    }

    private static function generateIv(string $trainerClass): int
    {
        $weightedDistribution = TrainerClass::getWeightedDistributionForIvs($trainerClass);

        if (is_null($weightedDistribution)) {
            return RandomNumberGenerator::generateInRange(0, 31);
        }

        return RandomNumberGenerator::generateFromWeightedTable($weightedDistribution);
    }

    private static function findBaseStats(string $number): array
    {
        $config = require __DIR__ . "/../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }

    public static function randomlyGenerateTrainerClass(): string
    {
        $trainerClasses = TrainerClass::all();

        foreach ($trainerClasses as $i => $trainerClass) {
            if (in_array($trainerClass, [
                TrainerClass::GYM_LEADER,
                TrainerClass::TEAM_ROCKET_GRUNT,
                TrainerClass::CHAMPION,
                TrainerClass::ROCKET,
                TrainerClass::ROCKET_EXECUTIVE,
                TrainerClass::AQUA_ADMIN,
                TrainerClass::AQUA_LEADER,
                TrainerClass::MAGMA_ADMIN,
                TrainerClass::MAGMA_LEADER,
                TrainerClass::OLD_COUPLE,
                TrainerClass::SIS_AND_BRO,
                TrainerClass::TEAMMATES,
                TrainerClass::TEAM_AQUA_GRUNT,
                TrainerClass::TEAM_MAGMA_GRUNT,
                TrainerClass::WINSTRATE,
                TrainerClass::YOUNG_COUPLE,
                TrainerClass::COOL_COUPLE,
                TrainerClass::TEAM_ROCKET_ADMIN,
                TrainerClass::BOSS,
                TrainerClass::ELITE_FOUR,
                TrainerClass::RETIRED_TRAINER,
                TrainerClass::RIVAL,
                TrainerClass::DOUBLE_TEAM,
                TrainerClass::TWINS,
            ])) {
                unset($trainerClasses[$i]);
            }
        }

        $trainerClasses = array_values($trainerClasses);

        $randomTrainerClassKey = RandomNumberGenerator::generateInRange(0, count($trainerClasses) - 1);

        return $trainerClasses[$randomTrainerClassKey];
    }
}
