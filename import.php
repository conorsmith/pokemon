<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\PokedexNo;

$dom = new DOMDocument();
$dom->loadHTMLFile(__DIR__ . "/location.html");

$titleNode = $dom->getElementById("Pokémon");

$tableNode = $titleNode->parentNode->nextSibling->nextSibling;

$i = 0;

$rawEncounterData = [];

/** @var DOMNode $rowNode */
foreach ($tableNode->getElementsByTagName("tr") as $rowNode) {
    $i++;
    $row = [];
    /** @var DOMNode $cellNode */
    foreach ($rowNode->childNodes as $cellNode) {
        if ($cellNode->nodeName !== "td") {
            continue;
        }
        $row[] = trim($cellNode->textContent);
    }

    if (count($row) !== 4) {
        continue;
    }

    $rawEncounterData[] = [
        'name' => $row[0],
        'type' => $row[1],
        'levels' => $row[2],
        'rate' => $row[3],
    ];
}

$encounterTypeReflector = new ReflectionClass(EncounterType::class);
$encounterTypeConstants = $encounterTypeReflector->getConstants();
unset($encounterTypeConstants['ALL']);
$encounterTypeConstants = array_flip($encounterTypeConstants);

$pokedexNoReflector = new ReflectionClass(PokedexNo::class);
$pokedexNoConstants = array_flip($pokedexNoReflector->getConstants());

$encounterTables = [];

foreach ($rawEncounterData as $data) {
    if ($data['type'] === "Grass") {
        $encounterType = EncounterType::WALKING;
    } elseif ($data['type'] === "Surfing") {
        $encounterType = EncounterType::SURFING;
    } elseif (substr($data['type'], 0, 7) === "Fishing") {
        $encounterType = EncounterType::FISHING;
    } elseif ($data['type'] === "Only one") {
        continue;
    } else {
        throw new Exception;
    }

    if (!array_key_exists($encounterType, $encounterTables)) {
        $encounterTables[$encounterType] = [];
    }

    $pokemonNumber = $pokedexNoReflector->getConstants()[strtoupper($data['name'])];

    if (strpos($data['levels'], ",") !== false) {
        $levels = array_map(fn($level) => intval(trim($level)), explode(",", $data['levels']));
        sort($levels);
    } elseif (strpos($data['levels'], "-") !== false) {
        $levels = explode("-", $data['levels']);
    } else {
        $levels = [$data['levels']];
    }

    if (!array_key_exists($pokemonNumber, $encounterTables[$encounterType])) {
        $encounterTables[$encounterType][$pokemonNumber] = [
            'weight' => intval($data['rate']),
            'levels' => count($levels) === 1 ? $levels[0] : [$levels[0], $levels[count($levels) - 1]],
        ];
    } else {
        $encounterTables[$encounterType][$pokemonNumber]['weight'] += intval($data['rate']);

        $allLevels = array_merge(
            is_array($encounterTables[$encounterType][$pokemonNumber]['levels'])
                ? $encounterTables[$encounterType][$pokemonNumber]['levels']
                : [$encounterTables[$encounterType][$pokemonNumber]['levels']],
            $levels,
        );

        $encounterTables[$encounterType][$pokemonNumber]['levels'] = count($allLevels) === 1 ? $allLevels[0] : [$allLevels[0], $allLevels[count($allLevels) - 1]];
    }
}

echo "[" . PHP_EOL;

foreach ($encounterTables as $encounterType => $encounterTable) {
    echo "    EncounterType::" . $encounterTypeConstants[$encounterType] . " => [" . PHP_EOL;
    foreach ($encounterTable as $pokemonId => $config) {
        echo "        PokedexNo::" . $pokedexNoConstants[$pokemonId] . " => [" . PHP_EOL;
        echo "            'weight' => {$config['weight']}," . PHP_EOL;
        if (is_array($config['levels'])) {
            echo "            'levels' => [{$config['levels'][0]}, {$config['levels'][1]}]," . PHP_EOL;
        } else {
            echo "            'levels' => {$config['levels']}," . PHP_EOL;
        }
        echo "        ]," . PHP_EOL;
    }
    echo "    ]," . PHP_EOL;
}

echo "]," . PHP_EOL;
echo PHP_EOL;
