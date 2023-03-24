<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\Import\BulbapediaPokedexPage;
use ConorSmith\Pokemon\Import\BulbapediaPokemonPage;
use ConorSmith\Pokemon\Import\BulbapediaLocationPage;
use ConorSmith\Pokemon\Import\EncountersConfig;
use ConorSmith\Pokemon\Import\EncounterTableFactory;
use ConorSmith\Pokemon\Import\PokemonConfig;
use ConorSmith\Pokemon\Import\PokedexNoConstants;
use ConorSmith\Pokemon\Import\PokedexNumberConstantFactory;
use ConorSmith\Pokemon\Import\PokemonSpeciesFactory;
use ConorSmith\Pokemon\Import\TrainerFactory;
use ConorSmith\Pokemon\Import\TrainersConfig;

if ($argc < 2 || !in_array($argv[1], ["encounters", "trainers", "pokemonIds", "pokemon"])) {
    echo PHP_EOL;
    echo "[ USAGE ]" . PHP_EOL;
    echo "php import.php [encounters|trainers|pokemonIds|pokemon] (pokemon:lower_bound) (pokemon:upper_bound)" . PHP_EOL . PHP_EOL;
    exit;
}

$bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/location.html");

if ($argv[1] === "encounters") {
    $encounterTableFactory = new EncounterTableFactory();

    $encounterTables = $encounterTableFactory->createEncounterTablesFromBulbapediaEncounters(
        $bulbapedia->extractEncounters(),
    );

    echo EncountersConfig::fromEncounterTables($encounterTables);

} elseif ($argv[1] === "trainers") {
    $trainerFactory = new TrainerFactory();

    $trainers = $trainerFactory->createTrainersFromBulbapediaTrainers(
        $bulbapedia->extractTrainers(),
    );

    echo TrainersConfig::fromTrainers($trainers);

} elseif ($argv[1] === "pokemonIds") {
    $bulbapedia = BulbapediaPokedexPage::fromFile(__DIR__ . "/pokedex.html");

    $pokedexNumberConstantFactory = new PokedexNumberConstantFactory();

    $constants = $pokedexNumberConstantFactory->createPokedexNumberConstantssFromBulbapedia(
        $bulbapedia->extractPokemonIds()
    );

    echo PokedexNoConstants::fromPokedexNumberConstants($constants);

} elseif ($argv[1] === "pokemon") {
    $lowerBound = $argv[2] ?? null;
    $upperBound = $argv[3] ?? null;

    $reflector = new ReflectionClass(\ConorSmith\Pokemon\PokedexNo::class);
    $constants = $reflector->getConstants();

    if ($lowerBound) {
        $constants = array_filter($constants, fn($constant) => $constant >= $lowerBound);
    }
    if ($upperBound) {
        $constants = array_filter($constants, fn($constant) => $constant <= $upperBound);
    }

    $pokemonSpeciesFactory = new PokemonSpeciesFactory();

    foreach ($constants as $constant) {

        $bulbapedia = BulbapediaPokemonPage::fromPokedexNumber(new \ConorSmith\Pokemon\Import\Domain\PokedexNumber($constant));

        $pokemonSpecies = $pokemonSpeciesFactory->createFromBulbapedia(
            $bulbapedia->extractPokemonSpecies()
        );

        echo PokemonConfig::fromPokemonSpecies($pokemonSpecies);
    }
}
