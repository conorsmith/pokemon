<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\ConsoleCommands;

use ConorSmith\Pokemon\SharedKernel\Domain\EncounterType;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\PokedexNo;
use ReflectionClass;

final class Convert
{
    public function __invoke(array $args): void
    {
        $map = require __DIR__ . "/../../../src/Config/Map.php";

        $encounterTypeReflector = new ReflectionClass(EncounterType::class);
        $encounterTypeConstants = $encounterTypeReflector->getConstants();
        unset($encounterTypeConstants['ALL']);
        $encounterTypeConstants = array_flip($encounterTypeConstants);

        $locationIdReflector = new ReflectionClass(LocationId::class);
        $locationIdConstants = array_flip($locationIdReflector->getConstants());

        $pokedexNoReflector = new ReflectionClass(PokedexNo::class);
        $pokedexNoConstants = array_flip($pokedexNoReflector->getConstants());

        $encounters = [];

        foreach ($map as $location) {
            if (array_key_exists('pokemon', $location)) {
                $encounterTables = $location['pokemon'];

                $isImplicitlyAWalkingTable = array_diff(array_keys($encounterTables), EncounterType::ALL) !== [];

                if ($isImplicitlyAWalkingTable) {
                    $encounterTables = [
                        EncounterType::WALKING => $encounterTables,
                    ];
                }

                $encounters[$location['id']] = $encounterTables;
            }
        }

        echo "<?php" . PHP_EOL;
        echo "declare(strict_types=1);" . PHP_EOL;
        echo PHP_EOL;
        echo "use ConorSmith\Pokemon\EncounterType;" . PHP_EOL;
        echo "use ConorSmith\Pokemon\LocationId;" . PHP_EOL;
        echo "use ConorSmith\Pokemon\PokedexNo;" . PHP_EOL;
        echo PHP_EOL;
        echo "return [" . PHP_EOL;

        foreach ($encounters as $locationId => $encounterData) {
            echo "    LocationId::" . $locationIdConstants[$locationId] . " => [" . PHP_EOL;
            foreach ($encounterData as $encounterType => $encounterTable) {
                echo "        EncounterType::" . $encounterTypeConstants[$encounterType] . " => [" . PHP_EOL;
                foreach ($encounterTable as $pokemonId => $config) {
                    echo "            PokedexNo::" . $pokedexNoConstants[$pokemonId] . " => [" . PHP_EOL;
                    echo "                'weight' => {$config['weight']}," . PHP_EOL;
                    if (is_array($config['levels'])) {
                        echo "                'levels' => [{$config['levels'][0]}, {$config['levels'][1]}]," . PHP_EOL;
                    } else {
                        echo "                'levels' => {$config['levels']}," . PHP_EOL;
                    }
                    echo "            ]," . PHP_EOL;
                }
                echo "        ]," . PHP_EOL;
            }
            echo "    ]," . PHP_EOL;
        }

        echo "];" . PHP_EOL;
        echo PHP_EOL;
    }
}
