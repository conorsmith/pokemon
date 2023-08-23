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
use LogicException;
use Ramsey\Uuid\Uuid;
use ReflectionClass;

final class TrainerFactory
{
    public function createTrainersFromBulbapediaTrainers(array $bulbapediaTrainers): array
    {
        $trainers = [];

        foreach ($bulbapediaTrainers as $key => $trainerGroup) {
            $trainers[$key] = [];
            foreach ($trainerGroup as $bulbapediaTrainer) {
                if (!isset($bulbapediaTrainer['trainer'])) {
                    continue;
                }

                $team = [];

                foreach ($bulbapediaTrainer['pokemon'] as $pokemon) {
                    $team[] = new TrainerPokemon(
                        self::createPokedexNumberFromPokemonName($pokemon['name']),
                        self::createSexFromSymbol($pokemon['sex']),
                        intval($pokemon['level']),
                    );
                }

                if ($bulbapediaTrainer['trainer']['name'] === "Red") {
                    $class = TrainerClass::RETIRED_TRAINER;
                } else {
                    $class = self::createTrainerClassFromName($bulbapediaTrainer['trainer']['class']);
                }

                $trainers[$key][] = new Trainer(
                    Uuid::uuid4()->toString(),
                    $class,
                    is_null($bulbapediaTrainer['trainer']['gender'])
                        ? self::createGenderFromClassName($bulbapediaTrainer['trainer']['class'])
                        : self::createGenderFromValue($bulbapediaTrainer['trainer']['gender']),
                    $bulbapediaTrainer['trainer']['name'],
                    $team,
                );
            }
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
        $constantName = str_replace("é", "E", $constantName);
        $constantName = str_replace(".", "", $constantName);

        return match ($constantName) {
            "EXECUTIVE" => TrainerClass::TEAM_ROCKET_ADMIN,
            "FISHER" => TrainerClass::FISHERMAN,
            "ACE_TRAINER" => TrainerClass::COOLTRAINER,
            "LI" => TrainerClass::ELDER,
            "POKE_MANIAC" => TrainerClass::POKEMANIAC,
            "ROCKET_GRUNT" => TrainerClass::TEAM_ROCKET_GRUNT,
            "POLICEMAN" => TrainerClass::OFFICER,
            "SILVER_(GAME)" => TrainerClass::RIVAL,
            "SCHOOLBOY" => TrainerClass::SCHOOL_KID,
            "BLACKBELT" => TrainerClass::BLACK_BELT,
            "MYSTERY_MAN" => TrainerClass::MYSTICALMAN,
            "POKE_FAN" => TrainerClass::POKEFAN,
            "MAXIE" => TrainerClass::MAGMA_LEADER,
            "ARCHIE" => TrainerClass::AQUA_LEADER,
            "SR_AND_JR" => TrainerClass::TEAMMATES,
            default => $trainerClassReflector->getConstants()[$constantName],
        };
    }

    public function createGenderFromClassName(string $class): Gender
    {
        return match (mb_substr($class, -1)) {
            "♀" => Gender::female(),
            "♂" => Gender::male(),
            default => Gender::irrelevant(),
        };
    }

    public function createGenderFromValue(string $value): Gender
    {
        return match($value) {
            "F" => Gender::female(),
            "M" => Gender::male(),
            default => throw new LogicException(),
        };
    }

    private function createPokedexNumberFromPokemonName(string $name): PokedexNumber
    {
        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);

        $name = str_replace(" ", "_", $name);
        $name = str_replace("'", "_", $name);
        $name = str_replace(".", "", $name);
        $name = str_replace("♀", "_F", $name);
        $name = str_replace("♂", "_M", $name);

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
