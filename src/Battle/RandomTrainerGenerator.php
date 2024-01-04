<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use Exception;
use Faker\Factory;
use Ramsey\Uuid\Uuid;

final class RandomTrainerGenerator
{
    public function __construct(
        private readonly array $pokedex,
    ) {}

    public function generate(int $opponentHighestLevel, string $locationId): Trainer
    {
        $faker = Factory::create();

        $trainerId = Uuid::uuid4()->toString();

        $trainerClasses = TrainerClass::all();
        $randomTrainerClassKey = RandomNumberGenerator::generateInRange(0, count($trainerClasses) - 1);
        $trainerClass = $trainerClasses[$randomTrainerClassKey];

        $anchorLevel = RandomNumberGenerator::generateInRange(
            $opponentHighestLevel - 10,
            $opponentHighestLevel + 10,
        );

        $party = [];

        $partySize = 6;

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
        $pokedexNumber = $this->findRandomPokedexNumber();

        $level = RandomNumberGenerator::generateInRange(
            intval(floor($anchorLevel * 0.9)),
            intval(ceil($anchorLevel * 1.1)),
        );

        $pokedexEntry = $this->findPokedexEntry($pokedexNumber);

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

    private function findRandomPokedexNumber(): string
    {
        $pokedexNumbers = array_keys($this->pokedex);
        $randomPokedexEntryKey = RandomNumberGenerator::generateInRange(0, count($pokedexNumbers) - 1);
        return strval($pokedexNumbers[$randomPokedexEntryKey]);
    }

    private function findPokedexEntry(string $number): array
    {
        if (!array_key_exists($number, $this->pokedex)) {
            throw new Exception("Given Pokémon Number '{$number}' does not exist in Pokédex");
        }

        return $this->pokedex[$number];
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
}
