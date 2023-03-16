<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\Import\BulbapediaLocationPage;
use ConorSmith\Pokemon\Import\EncountersConfig;
use ConorSmith\Pokemon\Import\EncounterTableFactory;
use ConorSmith\Pokemon\Import\TrainerFactory;
use ConorSmith\Pokemon\Import\TrainersConfig;

if ($argc !== 2 || !in_array($argv[1], ["encounters", "trainers"])) {
    echo PHP_EOL;
    echo "[ USAGE ]" . PHP_EOL;
    echo "php import.php [encounters|trainers]" . PHP_EOL . PHP_EOL;
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
}
