<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\UseCases;

use ConorSmith\Pokemon\Battle\Domain\Attack;
use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Round;
use ConorSmith\Pokemon\Battle\Domain\Stats;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Gender;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokemonType;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use Exception;
use Faker\Factory;
use Ramsey\Uuid\Uuid;
use RuntimeException;

final class SimulateABattle
{
    public function __construct(
        private readonly TrainerRepository $trainerRepository,
        private readonly EventFactory $eventFactory,
        private readonly array $pokedex,
    ) {}

    public function run(?string $trainerAId, ?string $trainerBId): ResultOfSimulatingABattle
    {
        if (is_null($trainerAId)) {
            $trainerA = $this->randomlyGenerateTrainer();
        } else {
            $trainerA = $this->trainerRepository->findTrainerByTrainerId($trainerAId);
        }
        if (is_null($trainerBId)) {
            $trainerB = $this->randomlyGenerateTrainer();
        } else {
            $trainerB = $this->trainerRepository->findTrainerByTrainerId($trainerBId);
        }

        $trainerA = $trainerA->startBattle();
        $trainerB = $trainerB->startBattle();

        while (!$trainerA->hasEntirePartyFainted() && !$trainerB->hasEntirePartyFainted()) {

            $trainerAPokemon = $trainerA->getLeadPokemon();
            $trainerBPokemon = $trainerB->getLeadPokemon();

            if (($trainerAPokemon->primaryType === PokemonType::NORMAL
                && $trainerAPokemon->secondaryType === null
                && $trainerBPokemon->primaryType === PokemonType::GHOST
                && $trainerBPokemon->secondaryType === null)
                ||
                ($trainerAPokemon->primaryType === PokemonType::GHOST
                && $trainerAPokemon->secondaryType === null
                && $trainerBPokemon->primaryType === PokemonType::NORMAL
                && $trainerBPokemon->secondaryType === null)
            ) {
                throw new RuntimeException("Halting execution to avoid infinite loop from stalemate");
            }

            $round = Round::execute(
                $trainerAPokemon,
                $trainerBPokemon,
                Attack::strongest($trainerAPokemon),
                Attack::strongest($trainerBPokemon),
            );

            $this->outputRoundEvents($round, $trainerA, $trainerB);
        }

        $trainerA = $trainerA->endBattle();
        $trainerB = $trainerB->endBattle();

        if (!is_null($trainerAId)) {
            $this->trainerRepository->saveTrainer($trainerA);
        }
        if (!is_null($trainerBId)) {
            $this->trainerRepository->saveTrainer($trainerB);
        }

        if ($trainerB->hasEntirePartyFainted()) {
            return ResultOfSimulatingABattle::victor($trainerA, $trainerB);

        } elseif ($trainerA->hasEntirePartyFainted()) {
            return ResultOfSimulatingABattle::victor($trainerB, $trainerA);

        } else {
            return ResultOfSimulatingABattle::draw();
        }
    }

    private function outputRoundEvents(Round $round, Trainer $trainerA, Trainer $trainerB): void
    {
        $nextFirstPokemon = $round->playerFirst
            ? ($trainerA->hasEntirePartyFainted() ? null : $trainerA->getLeadPokemon())
            : ($trainerB->hasEntirePartyFainted() ? null : $trainerB->getLeadPokemon());
        $nextSecondPokemon = $round->playerFirst
            ? ($trainerB->hasEntirePartyFainted() ? null : $trainerB->getLeadPokemon())
            : ($trainerA->hasEntirePartyFainted() ? null : $trainerA->getLeadPokemon());

        $events = array_merge(
            $this->eventFactory->createBattleRoundEvents(
                $round->firstAttack,
                $round->firstPokemon,
                $round->secondPokemon,
                !$round->playerFirst,
                $nextSecondPokemon,
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s"
                    : TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s",
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s"
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s",
                !$round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name,
            ),
            $this->eventFactory->createBattleRoundEvents(
                $round->secondAttack,
                $round->secondPokemon,
                $round->firstPokemon,
                $round->playerFirst,
                $nextFirstPokemon,
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s"
                    : TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s",
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name . "'s"
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name . "'s",
                $round->playerFirst
                    ? TrainerClass::getLabel($trainerA->class) . " " . $trainerA->name
                    : TrainerClass::getLabel($trainerB->class) . " " . $trainerB->name,
            ),
        );

        foreach ($events as $event) {
            if ($event['type'] === "message") {
                $message = $event['value'];
                echo $message . PHP_EOL;
            }
        }

        echo PHP_EOL;
    }

    private function randomlyGenerateTrainer(): Trainer
    {
        $faker = Factory::create();

        $trainerClasses = TrainerClass::all();
        $randomTrainerClassKey = RandomNumberGenerator::generateInRange(0, count($trainerClasses) - 1);
        $trainerClass = $trainerClasses[$randomTrainerClassKey];

        $playerMaxLevel = 100;

        $anchorLevel = RandomNumberGenerator::generateInRange(10, $playerMaxLevel + 5);

        $party = [];

        for ($i = 0; $i < RandomNumberGenerator::generateInRange(1, 6); $i++) {
            $party[] = $this->randomlyGeneratePokemon($trainerClass, $anchorLevel);
        }

        return new Trainer(
            Uuid::uuid4()->toString(),
            $faker->firstName,
            $trainerClass,
            match (RandomNumberGenerator::generateInRange(0, 2)) {
                0 => Gender::MALE,
                1 => Gender::FEMALE,
                2 => Gender::IMMATERIAL,
            },
            $party,
            LocationId::PALLET_TOWN,
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
        $config = require __DIR__ . "/../../Config/Stats.php";

        /** @var array $entry */
        foreach ($config as $entry) {
            if ($entry['number'] === $number) {
                return $entry;
            }
        }

        throw new Exception;
    }
}
