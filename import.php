<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\Import\BulbapediaLocationPage;
use ConorSmith\Pokemon\Import\EncountersConfig;
use ConorSmith\Pokemon\Import\EncounterTableFactory;

$bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/location.html");
$encounterTableFactory = new EncounterTableFactory();

$encounterTables = $encounterTableFactory->createEncounterTablesFromBulbapediaEncounters(
    $bulbapedia->extractEncounters(),
);

echo EncountersConfig::fromEncounterTables($encounterTables);
