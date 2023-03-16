<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\Gender;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\Sex;
use ConorSmith\Pokemon\Import\Domain\Trainer;
use ConorSmith\Pokemon\Import\Domain\TrainerPokemon;
use ConorSmith\Pokemon\PokedexNo;
use ConorSmith\Pokemon\TrainerClass;
use Ramsey\Uuid\Uuid;
use ReflectionClass;

final class TrainerFactory
{
    public function createTrainersFromBulbapediaTrainers(array $bulbapediaTrainers): array
    {
        $trainers = [];

        foreach ($bulbapediaTrainers as $bulbapediaTrainer) {
            $team = [];

            foreach ($bulbapediaTrainer['pokemon'] as $pokemon) {
                $team[] = new TrainerPokemon(
                    self::createPokedexNumberFromPokemonName($pokemon['name']),
                    self::createSexFromSymbol($pokemon['sex']),
                    intval($pokemon['level']),
                );
            }

            $trainers[] = new Trainer(
                Uuid::uuid4()->toString(),
                self::createTrainerClassFromName($bulbapediaTrainer['trainer']['class']),
                self::createGenderFromClassName($bulbapediaTrainer['trainer']['class']),
                $bulbapediaTrainer['trainer']['name'],
                $team,
            );
        }

        return $trainers;
    }

    public function createTrainerClassFromName(string $class): string
    {
        $trainerClassReflector = new ReflectionClass(TrainerClass::class);

        $constantName = strtoupper($class);
        $constantName = str_replace(" ", "_", $constantName);
        $constantName = str_replace("♀", "", $constantName);
        $constantName = str_replace("♂", "", $constantName);

        return $trainerClassReflector->getConstants()[$constantName];
    }

    public function createGenderFromClassName(string $class): Gender
    {
        return match (mb_substr($class, -1)) {
            "♀" => Gender::female(),
            "♂" => Gender::male(),
            default => Gender::irrelevant(),
        };
    }

    private function createPokedexNumberFromPokemonName(string $name): PokedexNumber
    {
        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);

        return new PokedexNumber(
            $pokedexNoReflector->getConstants()[strtoupper($name)],
        );
    }

    public function createSexFromSymbol(string $gender): Sex
    {
        return match ($gender) {
            "♀" => Sex::female(),
            "♂" => Sex::male(),
            default => Sex::unknown(),
        };
    }
}
