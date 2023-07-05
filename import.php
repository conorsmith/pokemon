<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\Import\BulbapediaEvsPage;
use ConorSmith\Pokemon\Import\BulbapediaSexRatiosPage;
use ConorSmith\Pokemon\Import\BulbapediaPokedexPage;
use ConorSmith\Pokemon\Import\BulbapediaPokemonPage;
use ConorSmith\Pokemon\Import\BulbapediaLocationPage;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEvYield;
use ConorSmith\Pokemon\Import\Domain\PokemonSexRatio;
use ConorSmith\Pokemon\Import\EncountersConfig;
use ConorSmith\Pokemon\Import\EncounterTableFactory;
use ConorSmith\Pokemon\Import\EvYieldsConfig;
use ConorSmith\Pokemon\Import\SexRatiosConfig;
use ConorSmith\Pokemon\Import\PokemonConfig;
use ConorSmith\Pokemon\Import\PokedexNoConstants;
use ConorSmith\Pokemon\Import\PokedexNumberConstantFactory;
use ConorSmith\Pokemon\Import\PokemonSpeciesFactory;
use ConorSmith\Pokemon\Import\TrainerFactory;
use ConorSmith\Pokemon\Import\TrainersConfig;
use ConorSmith\Pokemon\PokedexNo;

if ($argc < 2 || !in_array($argv[1], ["encounters", "trainers", "pokemonIds", "pokemon", "evs", "check", "sex"])) {
    echo PHP_EOL;
    echo "[ USAGE ]" . PHP_EOL;
    echo "php import.php [encounters|trainers|pokemonIds|pokemon|evs|check|sex] (pokemon:lower_bound) (pokemon:upper_bound)" . PHP_EOL . PHP_EOL;
    exit;
}

if ($argv[1] === "encounters") {
    if (isset($argv[2])) {
        $bulbapedia = BulbapediaLocationPage::fromUrl($argv[2]);
    } else {
        $bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/.cache/location.html");
    }

    $encounterTableFactory = new EncounterTableFactory();

    $encounterTables = $encounterTableFactory->createEncounterTablesFromBulbapediaEncounters(
        $bulbapedia->extractEncounters(),
    );

    echo EncountersConfig::fromEncounterTables($encounterTables);

} elseif ($argv[1] === "trainers") {
    if (isset($argv[2])) {
        $bulbapedia = BulbapediaLocationPage::fromUrl($argv[2]);
    } else {
        $bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/.cache/location.html");
    }

    $trainerFactory = new TrainerFactory();

    $trainers = $trainerFactory->createTrainersFromBulbapediaTrainers(
        $bulbapedia->extractTrainers(),
    );

    echo TrainersConfig::fromTrainers($trainers);

} elseif ($argv[1] === "pokemonIds") {
    $bulbapedia = BulbapediaPokedexPage::fromFile(__DIR__ . "/.cache/pokedex.html");

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
} elseif ($argv[1] === "evs") {

    $bulbapedia = BulbapediaEvsPage::fromFile(__DIR__ . "/.cache/evs.html");

    $evYields = [];

    foreach ($bulbapedia->extractEvs() as $bulbapediaEntry) {
        $evYields[] = new PokemonEvYield(
            new PokedexNumber(strval(intval($bulbapediaEntry['pokedexNumber']))),
            $bulbapediaEntry['form'] ?? null,
            $bulbapediaEntry['exp'] === "Unknown" ? null : intval($bulbapediaEntry['exp']),
            intval($bulbapediaEntry['hp']),
            intval($bulbapediaEntry['physicalAttack']),
            intval($bulbapediaEntry['physicalDefence']),
            intval($bulbapediaEntry['specialAttack']),
            intval($bulbapediaEntry['specialDefence']),
            intval($bulbapediaEntry['speed']),
        );
    }

    echo EvYieldsConfig::fromPokemonEvYields($evYields);

} elseif ($argv[1] === "check") {

    $pokedex = require __DIR__ . "/src/Config/Pokedex.php";
    $encounters = require __DIR__ . "/src/Config/Encounters/Johto.php";

    $encounterablePokedexNumbers = [];

    foreach ($encounters as $locationEncounters) {
        foreach ($locationEncounters as $encounters) {
            foreach ($encounters as $pokedexNumber => $encounter) {
                $encounterablePokedexNumbers[] = $pokedexNumber;
            }
        }
    }

    $encounterablePokedexNumbers = array_unique($encounterablePokedexNumbers);
    sort($encounterablePokedexNumbers);

    $pokemonByIds = array_flip((new ReflectionClass(PokedexNo::class))->getConstants());

    $unencounterableJohtoPokemon = [];

    for ($i = 152; $i <= 251; $i++) {
        if (!in_array($i, $encounterablePokedexNumbers)) {
            $unencounterableJohtoPokemon[] = $pokemonByIds[$i];
        }
    }

    dd($unencounterableJohtoPokemon);

} elseif ($argv[1] === "sex") {

    $bulbapedia = BulbapediaSexRatiosPage::fromFile(__DIR__ . "/.cache/sex.html");

    $sexRatios = [];

    foreach ($bulbapedia->extractSexRatios() as $bulbapediaEntry) {
        $sexRatios[] = new PokemonSexRatio(
            new PokedexNumber(strval(intval($bulbapediaEntry['number']))),
            $bulbapediaEntry['ratio']['female'] ?? 0,
            $bulbapediaEntry['ratio']['male'] ?? 0,
            $bulbapediaEntry['ratio']['unknown'] ?? 0,
        );
    }

    usort($sexRatios, function (PokemonSexRatio $a, PokemonSexRatio $b) {
        return $a->pokedexNumber->value > $b->pokedexNumber->value;
    });

    echo SexRatiosConfig::fromPokemonSexRatios($sexRatios);
}
