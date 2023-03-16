<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Import;

use ConorSmith\Pokemon\Import\Domain\Gender;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\Sex;
use ConorSmith\Pokemon\Import\Domain\Trainer;
use ConorSmith\Pokemon\Import\Domain\TrainerPokemon;
use ConorSmith\Pokemon\PokedexNo as PokedexNumberConstants;
use ConorSmith\Pokemon\TrainerClass as TrainerClassConstants;
use Exception;
use ReflectionClass;

final class TrainersConfig
{
    public static function fromTrainers(array $trainers): string
    {
        $config = "";

        $config .= "[" . PHP_EOL;

        /** @var Trainer $trainer */
        foreach ($trainers as $trainer) {
            $config .= self::encodeTrainer($trainer);
        }

        $config .= "]," . PHP_EOL;
        $config .= PHP_EOL;

        return $config;
    }

    private static function encodeTrainer(Trainer $trainer): string
    {
        $config = "";

        $config .= "    [" . PHP_EOL;
        $config .= "        'id' => \"{$trainer->id}\"," . PHP_EOL;
        $config .= "        'class' => " . self::encodeTrainerClass($trainer->class) . "," . PHP_EOL;
        if ($trainer->gender->isRelevant()) {
            $config .= "        'gender' => " . self::encodeGender($trainer->gender) . "," . PHP_EOL;

        }
        $config .= "        'name' => \"{$trainer->name}\"," . PHP_EOL;
        $config .= "        'team' => [" . PHP_EOL;
        /** @var TrainerPokemon $pokemon */
        foreach ($trainer->team as $pokemon) {
            $config .= self::encodeTrainerPokemon($pokemon);
        }
        $config .= "        ]," . PHP_EOL;
        $config .= "    ]," . PHP_EOL;

        return $config;
    }

    private static function encodeTrainerClass(string $trainerClassId): string
    {
        $reflector = new ReflectionClass(TrainerClassConstants::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$trainerClassId];
    }

    private static function encodeGender(Gender $gender): string
    {
        if ($gender->isFemale()) {
            return "Gender::FEMALE";
        } elseif ($gender->isMale()) {
            return "Gender::MALE";
        } else {
            throw new Exception;
        }
    }

    private static function encodeTrainerPokemon(TrainerPokemon $pokemon): string
    {
        $config = "";

        $config .= "            [" . PHP_EOL;
        $config .= "                'id' => " . self::encodePokedexNumber($pokemon->pokedexNumber) . "," . PHP_EOL;
        $config .= "                'sex' => " . self::encodeSex($pokemon->sex) . "," . PHP_EOL;
        $config .= "                'level' => {$pokemon->level}," . PHP_EOL;
        $config .= "            ]," . PHP_EOL;

        return $config;
    }

    private static function encodePokedexNumber(PokedexNumber $pokedexNumber): string
    {
        $reflector = new ReflectionClass(PokedexNumberConstants::class);
        $constants = array_flip($reflector->getConstants());

        return $reflector->getShortName() . "::" . $constants[$pokedexNumber->value];
    }

    private static function encodeSex(Sex $sex): string
    {
        if ($sex->isFemale()) {
            return "Sex::FEMALE";
        } elseif ($sex->isMale()) {
            return "Sex::MALE";
        } else {
            return "Sex::UNKNOWN";
        }
    }
}