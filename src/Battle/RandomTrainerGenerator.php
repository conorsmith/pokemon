<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Party\Domain\EggGroup;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\AttributeTag;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Exception;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

final class RandomTrainerGenerator
{
    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
    ) {}

    public function generate(int $opponentHighestLevel, string $locationId): Trainer
    {
        $faker = Factory::create();

        $trainerId = Uuid::uuid4()->toString();

        $trainerClass = RandomTrainerGenerator::randomlyGenerateTrainerClass();

        $anchorLevel = RandomNumberGenerator::generateInRange(
            $opponentHighestLevel - 10,
            $opponentHighestLevel + 5,
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

        $gender = $this->randomlyGenerateGender($trainerClass);

        return new Trainer(
            $trainerId,
            match ($gender) {
                Gender::FEMALE     => $faker->firstNameFemale,
                Gender::IMMATERIAL => $faker->firstName,
                Gender::MALE       => $faker->firstNameMale,
            },
            $trainerClass,
            $gender,
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
            TrainerClass::BEAUTY            => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::CUTE)),
            TrainerClass::BIKER             => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::POISON)),
            ),
            TrainerClass::BIRD_KEEPER       => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::BIRD)),
            TrainerClass::BLACK_BELT        => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::BUG_CATCHER       => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::BUG)),
            TrainerClass::BURGLAR           => array_merge(
                [
                    PokedexNo::KOFFING,
                    PokedexNo::WEEZING,
                ],
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE)),
            ),
            TrainerClass::CHANNELER         => [
                PokedexNo::GASTLY,
                PokedexNo::HAUNTER,
                PokedexNo::GENGAR,
            ],
            TrainerClass::CUE_BALL          => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::ENGINEER          => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ELECTRIC)),
            TrainerClass::FISHERMAN         => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::AQUATIC)),
            TrainerClass::GENTLEMAN         => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::PET)),
            TrainerClass::CAMPER            => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::WOODS_DWELLER)),
            TrainerClass::PICNICKER         => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::WOODS_DWELLER)),
            TrainerClass::JUGGLER           => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::SPHERICAL)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::PSYCHIC)),
            ),
            TrainerClass::LASS              => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::CUTE)),
            TrainerClass::POKEMANIAC        => array_keys($this->pokedexConfigRepository->findAllInEggGroup(EggGroup::MONSTER)),
            TrainerClass::PSYCHIC           => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::PSYCHIC)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::GHOST)),
            ),
            TrainerClass::GUITARIST         => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ELECTRIC)),
                [
                    PokedexNo::ZUBAT,
                    PokedexNo::GOLBAT,
                    PokedexNo::CROBAT,
                    PokedexNo::WHISMUR,
                    PokedexNo::LOUDRED,
                    PokedexNo::EXPLOUD,
                ]
            ),
            TrainerClass::SAILOR            => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
                [
                    PokedexNo::RATICATE,
                    PokedexNo::MACHOP,
                    PokedexNo::MACHOKE,
                    PokedexNo::MACHAMP,
                ],
            ),
            TrainerClass::SCIENTIST         => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::INORGANIC)),
            TrainerClass::SUPER_NERD        => array_keys($this->pokedexConfigRepository->findAllWithAttributeTag(AttributeTag::INORGANIC)),
            TrainerClass::SWIMMER           => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
            TrainerClass::BOARDER           => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ICE)),
            TrainerClass::FIREBREATHER      => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE)),
                [
                    PokedexNo::KOFFING,
                    PokedexNo::WEEZING,
                ],
            ),
            TrainerClass::KIMONO_GIRL       => [
                PokedexNo::EEVEE,
                PokedexNo::VAPOREON,
                PokedexNo::JOLTEON,
                PokedexNo::FLAREON,
                PokedexNo::ESPEON,
                PokedexNo::UMBREON,
                PokedexNo::LEAFEON,
                PokedexNo::GLACEON,
                PokedexNo::SYLVEON,
            ],
            TrainerClass::MEDIUM            => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::PSYCHIC)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::GHOST)),
            ),
            TrainerClass::POKEFAN           => array_keys($this->pokedexConfigRepository->findAllInEggGroup(EggGroup::FAIRY)),
            TrainerClass::SKIER             => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ICE)),
            TrainerClass::BATTLE_GIRL       => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::BUG_MANIAC        => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::BUG)),
            TrainerClass::DRAGON_TAMER      => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::DRAGON)),
                array_keys($this->pokedexConfigRepository->findAllInEggGroup(EggGroup::DRAGON)),
            ),
            TrainerClass::EXPERT            => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::HEX_MANIAC        => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::PSYCHIC)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::GHOST)),
            ),
            TrainerClass::KINDLER           => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIRE)),
            TrainerClass::NINJA_BOY         => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::POISON)),
                [
                    PokedexNo::NINCADA,
                    PokedexNo::NINJASK,
                ],
            ),
            TrainerClass::PARASOL_LADY      => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
            TrainerClass::TRIATHLETE        => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::ELECTRIC)),
                [
                    PokedexNo::DODUO,
                    PokedexNo::DODRIO,
                ]
            ),
            TrainerClass::TUBER             => array_merge(
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::WATER)),
                array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::NORMAL)),
            ),
            TrainerClass::CRUSH_GIRL        => array_keys($this->pokedexConfigRepository->findAllWithType(PokemonType::FIGHTING)),
            TrainerClass::PAINTER           => [
                PokedexNo::SMEARGLE,
            ],
            default                         => $this->findAllPokemonUsedByTrainerClass($trainerClass),
        };

        $randomPokedexEntryKey = RandomNumberGenerator::generateInRange(0, count($pokedexNumbers) - 1);
        return strval($pokedexNumbers[$randomPokedexEntryKey]);
    }

    private function findAllPokemonUsedByTrainerClass(string $trainerClass): array
    {
        $trainers = $this->trainerConfigRepository->findTrainersWithClass($trainerClass);

        $pokedexNumbers = [];

        foreach ($trainers as $trainer) {
            foreach ($trainer['party'] as $trainerPokemonConfig) {
                $pokedexNumbers[] = $trainerPokemonConfig['id'];
            }
        }

        $pokedexNumbers = array_unique($pokedexNumbers);

        $pokedexNumbersInclEvolutions = [];

        foreach ($pokedexNumbers as $pokedexNumber) {
            $pokedexNumbersInclEvolutions = array_merge(
                $pokedexNumbersInclEvolutions,
                [$pokedexNumber],
                $this->findEvolutions($pokedexNumber),
            );
        }

        return array_values(array_unique($pokedexNumbersInclEvolutions));
    }

    private function findEvolutions(string $pokedexNumber): array
    {
        $pokedexEntry = $this->pokedexConfigRepository->find($pokedexNumber);

        if (!array_key_exists('evolutions', $pokedexEntry)) {
            return [];
        }

        $evolutionPokedexNumbers = [];

        foreach ($pokedexEntry['evolutions'] as $evolutionPokedexNumber => $config) {
            $evolutionPokedexNumbers = array_merge(
                $evolutionPokedexNumbers,
                [strval($evolutionPokedexNumber)],
                $this->findEvolutions(strval($evolutionPokedexNumber)),
            );
        }

        return $evolutionPokedexNumbers;
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
                TrainerClass::CRUSH_KIN,
                TrainerClass::INTERVIEWER,
            ])) {
                unset($trainerClasses[$i]);
            }
        }

        $trainerClasses = array_values($trainerClasses);

        $randomTrainerClassKey = RandomNumberGenerator::generateInRange(0, count($trainerClasses) - 1);

        return $trainerClasses[$randomTrainerClassKey];
    }

    public function randomlyGenerateGender(string $trainerClass): Gender
    {
        if (in_array(
            $trainerClass,
            [
                TrainerClass::BEAUTY,
                TrainerClass::PICNICKER,
                TrainerClass::LASS,
                TrainerClass::KIMONO_GIRL,
                TrainerClass::AROMA_LADY,
                TrainerClass::BATTLE_GIRL,
                TrainerClass::LADY,
                TrainerClass::PARASOL_LADY,
                TrainerClass::CRUSH_GIRL,
            ]
        )) {
            return Gender::FEMALE;
        }

        if (in_array(
            $trainerClass,
            [
                TrainerClass::CUE_BALL,
                TrainerClass::GAMER,
                TrainerClass::GENTLEMAN,
                TrainerClass::CAMPER,
                TrainerClass::YOUNGSTER,
                TrainerClass::NINJA_BOY,
                TrainerClass::RICH_BOY,
                TrainerClass::FISHERMAN,
            ]
        )) {
            return Gender::MALE;
        }

        if (in_array(
            $trainerClass,
            [
                TrainerClass::MEDIUM,
                TrainerClass::TEACHER,
                TrainerClass::HEX_MANIAC,
            ]
        )) {
            return match (RandomNumberGenerator::generateInRange(0, 1)) {
                0 => Gender::FEMALE,
                1 => Gender::IMMATERIAL,
            };
        }

        if (in_array(
            $trainerClass,
            [
                TrainerClass::BLACK_BELT,
                TrainerClass::BURGLAR,
                TrainerClass::SAILOR,
                TrainerClass::FIREBREATHER,
                TrainerClass::GUITARIST,
                TrainerClass::SAGE,
                TrainerClass::RUIN_MANIAC,
            ]
        )) {
            return match (RandomNumberGenerator::generateInRange(0, 1)) {
                0 => Gender::IMMATERIAL,
                1 => Gender::MALE,
            };
        }

        return match (RandomNumberGenerator::generateInRange(0, 2)) {
            0 => Gender::FEMALE,
            1 => Gender::IMMATERIAL,
            2 => Gender::MALE,
        };
    }
}
