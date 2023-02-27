<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

use ConorSmith\Pokemon\PokedexNo;

$dom = new DOMDocument();
$dom->loadHTMLFile(__DIR__ . "/rates.html");

$i = 0;

$config = [];

/** @var DOMNode $rowNode */
foreach ($dom->getElementsByTagName("tr") as $rowNode) {
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

    $configEntry = [
        'number' => ltrim(substr($row[0], 1), "0"),
        'rate' => intval(preg_replace("/[^0-9]/", "", $row[3])),
    ];

    $config[] = $configEntry;
}

$pokedexNoReflector = new ReflectionClass(PokedexNo::class);
$pokedexNoConstants = array_flip($pokedexNoReflector->getConstants());

echo "return [" . PHP_EOL;

foreach ($config as $entry) {
    echo "    [" . PHP_EOL;
    foreach ($entry as $key => $value) {
        echo "        '{$key}' => ";
        if (is_int($value)) {
            echo $value;
        } else {

            if (isset($pokedexNoConstants[$value])) {
                echo "PokedexNo::" . $pokedexNoConstants[$value];
            } else {
                echo "\"{$value}\"";
            }
        }
        echo "," . PHP_EOL;
    }
    echo "    ]," . PHP_EOL;
}

echo "];";
