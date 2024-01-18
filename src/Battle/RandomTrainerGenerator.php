<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\StatsFactory;
use ConorSmith\Pokemon\Battle\Domain\StatsIv;
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
    private const TRAINER_CLASS_BLACKLIST = [
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
        TrainerClass::POKEMON_TRAINER,
    ];

    private const TRAINER_CLASS_FEMALE_ONLY = [
        TrainerClass::BEAUTY,
        TrainerClass::PICNICKER,
        TrainerClass::LASS,
        TrainerClass::KIMONO_GIRL,
        TrainerClass::AROMA_LADY,
        TrainerClass::BATTLE_GIRL,
        TrainerClass::LADY,
        TrainerClass::PARASOL_LADY,
        TrainerClass::CRUSH_GIRL,
    ];

    private const TRAINER_CLASS_FEMALE_NEVER = [
        TrainerClass::BLACK_BELT,
        TrainerClass::BURGLAR,
        TrainerClass::SAILOR,
        TrainerClass::FIREBREATHER,
        TrainerClass::GUITARIST,
        TrainerClass::SAGE,
        TrainerClass::RUIN_MANIAC,
    ];

    private const TRAINER_CLASS_MALE_ONLY = [
        TrainerClass::CUE_BALL,
        TrainerClass::GAMER,
        TrainerClass::GENTLEMAN,
        TrainerClass::CAMPER,
        TrainerClass::YOUNGSTER,
        TrainerClass::NINJA_BOY,
        TrainerClass::RICH_BOY,
        TrainerClass::FISHERMAN,
    ];

    private const TRAINER_CLASS_MALE_NEVER = [
        TrainerClass::MEDIUM,
        TrainerClass::TEACHER,
        TrainerClass::HEX_MANIAC,
    ];


    public function __construct(
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
    ) {}

    public function generate(int $opponentHighestLevel, string $locationId): Trainer
    {
        $trainerId = Uuid::uuid4()->toString();

        $trainerClass = self::generateTrainerClass();

        $gender = self::generateGender($trainerClass);

        return new Trainer(
            $trainerId,
            self::generateName($gender),
            $trainerClass,
            $gender,
            $this->generateParty($trainerId, $trainerClass, $opponentHighestLevel),
            $locationId,
            true,
            null,
        );
    }

    public static function generateTrainerClass(): string
    {
        $trainerClasses = TrainerClass::all();

        foreach ($trainerClasses as $i => $trainerClass) {
            if (in_array($trainerClass, self::TRAINER_CLASS_BLACKLIST)) {
                unset($trainerClasses[$i]);
            }
        }

        return RandomNumberGenerator::selectFromArray($trainerClasses);
    }

    public static function generateGender(string $trainerClass): Gender
    {
        if (in_array($trainerClass, self::TRAINER_CLASS_FEMALE_ONLY)) {
            return Gender::FEMALE;
        }

        if (in_array($trainerClass, self::TRAINER_CLASS_MALE_ONLY)) {
            return Gender::MALE;
        }

        if (in_array($trainerClass, self::TRAINER_CLASS_MALE_NEVER)) {
            return RandomNumberGenerator::selectFromArray([
                Gender::FEMALE,
                Gender::IMMATERIAL,
            ]);
        }

        if (in_array($trainerClass, self::TRAINER_CLASS_FEMALE_NEVER)) {
            return RandomNumberGenerator::selectFromArray([
                Gender::IMMATERIAL,
                Gender::MALE,
            ]);
        }

        return RandomNumberGenerator::selectFromArray([
            Gender::FEMALE,
            Gender::IMMATERIAL,
            Gender::MALE,
        ]);
    }

    private static function generateName(Gender $gender): string
    {
        $faker = Factory::create();

        return match ($gender) {
            Gender::FEMALE     => $faker->firstNameFemale,
            Gender::IMMATERIAL => $faker->firstName,
            Gender::MALE       => $faker->firstNameMale,
        };
    }

    private function generateParty(
        string $trainerId,
        string $trainerClass,
        int $opponentHighestLevel,
    ): array {

        $anchorLevel = RandomNumberGenerator::generateInRange(
            max($opponentHighestLevel - 10, 1),
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
            $party[] = $this->generatePokemon($trainerClass, $anchorLevel);
        }

        usort($party, function (Pokemon $memberA, Pokemon $memberB) {
            $memberATotalStats = $memberA->stats->calculateHp()
                + $memberA->stats->calculatePhysicalAttack()
                + $memberA->stats->calculatePhysicalDefence()
                + $memberA->stats->calculateSpecialAttack()
                + $memberA->stats->calculateSpecialDefence()
                + $memberA->stats->calculateSpeed();

            $memberBTotalStats = $memberB->stats->calculateHp()
                + $memberB->stats->calculatePhysicalAttack()
                + $memberB->stats->calculatePhysicalDefence()
                + $memberB->stats->calculateSpecialAttack()
                + $memberB->stats->calculateSpecialDefence()
                + $memberB->stats->calculateSpeed();

            return $memberATotalStats > $memberBTotalStats;
        });

        RandomNumberGenerator::unsetSeed();

        return $party;
    }

    private function generatePokemon(string $trainerClass, int $anchorLevel): Pokemon
    {
        $pokedexNumber = $this->generatePokedexNumber($trainerClass);

        $level = RandomNumberGenerator::generateInRange(
            intval(ceil($anchorLevel * 0.9)),
            intval(floor($anchorLevel * 1.1)),
        );

        $pokedexEntry = $this->pokedexConfigRepository->find($pokedexNumber);

        $sex = self::generateSex($pokedexEntry['sexRatio']);

        $pokemon = new Pokemon(
            Uuid::uuid4()->toString(),
            $pokedexNumber,
            null,
            $pokedexEntry['type'][0],
            $pokedexEntry['type'][1] ?? null,
            $level,
            255,
            $sex,
            self::generateIsShiny(),
            StatsFactory::createStats(
                $level,
                $pokedexEntry,
                StatsFactory::generateIvsForTrainerClass($trainerClass)
            ),
            0,
            false,
        );

        $pokemon->remainingHp = $pokemon->calculateHp();

        return $pokemon;
    }

    private function generatePokedexNumber(string $trainerClass): string
    {
        $pokedexNumbers = $this->findPokemonPoolForTrainerClass($trainerClass);

        return strval(RandomNumberGenerator::selectFromArray($pokedexNumbers));
    }

    private static function generateSex(array $sexRatioConfig): Sex
    {
        $aggregatedWeight = array_reduce(
            $sexRatioConfig,
            function ($carry, array $sexRatioEntry) {
                return $carry + $sexRatioEntry['weight'];
            },
            0,
        );

        $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

        /** @var array $sexRatioEntry */
        foreach ($sexRatioConfig as $sexRatioEntry) {
            $randomlySelectedValue -= $sexRatioEntry['weight'];
            if ($randomlySelectedValue <= 0) {
                return $sexRatioEntry['sex'];
            }
        }

        throw new Exception;
    }

    private static function generateIsShiny(): bool
    {
        return RandomNumberGenerator::generateInRange(0, 4095) === 0;
    }

    private function findPokemonPoolForTrainerClass(string $trainerClass): array
    {
        return match ($trainerClass) {
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
            default                         => $this->findAllPokemonUsedByTrainersOfClass($trainerClass),
        };
    }

    private function findAllPokemonUsedByTrainersOfClass(string $trainerClass): array
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
}
