<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\ConsoleCommands;

use ConorSmith\Pokemon\Import\BulbapediaEggCyclesPage;
use ConorSmith\Pokemon\Import\BulbapediaEvsPage;
use ConorSmith\Pokemon\Import\BulbapediaLocationPage;
use ConorSmith\Pokemon\Import\BulbapediaPokedexPage;
use ConorSmith\Pokemon\Import\BulbapediaPokemonPage;
use ConorSmith\Pokemon\Import\BulbapediaSexRatiosPage;
use ConorSmith\Pokemon\Import\Domain\PokedexNumber;
use ConorSmith\Pokemon\Import\Domain\PokemonEggCycles;
use ConorSmith\Pokemon\Import\Domain\PokemonEvYield;
use ConorSmith\Pokemon\Import\Domain\PokemonSexRatio;
use ConorSmith\Pokemon\Import\EggCyclesConfig;
use ConorSmith\Pokemon\Import\EggGroupsConfig;
use ConorSmith\Pokemon\Import\EncountersConfig;
use ConorSmith\Pokemon\Import\EncounterTableFactory;
use ConorSmith\Pokemon\Import\EvYieldsConfig;
use ConorSmith\Pokemon\Import\PokedexNoConstants;
use ConorSmith\Pokemon\Import\PokedexNumberConstantFactory;
use ConorSmith\Pokemon\Import\PokemonConfig;
use ConorSmith\Pokemon\Import\PokemonEggGroupsFactory;
use ConorSmith\Pokemon\Import\PokemonSpeciesFactory;
use ConorSmith\Pokemon\Import\SexRatiosConfig;
use ConorSmith\Pokemon\Import\TrainerFactory;
use ConorSmith\Pokemon\Import\TrainersConfig;
use ConorSmith\Pokemon\PokedexNo;
use ReflectionClass;

final class Import
{
    public function __invoke(array $args): void
    {
        if (count($args) < 1 || !in_array($args[0], ["encounters", "trainers", "pokemonIds", "pokemon", "evs", "check", "sex", "eggcycles", "egggroups"])) {
            echo PHP_EOL;
            echo "[ USAGE ]" . PHP_EOL;
            echo "php console.php import [encounters|trainers|pokemonIds|pokemon|evs|check|sex|eggcycles|egggroups] (pokemon:lower_bound) (pokemon:upper_bound)" . PHP_EOL . PHP_EOL;
            return;
        }

        if ($args[0] === "encounters") {
            if (isset($args[1])) {
                $bulbapedia = BulbapediaLocationPage::fromUrl($args[1]);
            } else {
                $bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/../../../.cache/location.html");
            }

            $encounterTableFactory = new EncounterTableFactory();

            $encounterTables = $encounterTableFactory->createEncounterTablesFromBulbapediaEncounters(
                $bulbapedia->extractEncounters($args[2] ?? null),
            );

            echo EncountersConfig::fromEncounterTables($encounterTables);

        } elseif ($args[0] === "trainers") {
            if (isset($args[1])) {
                $bulbapedia = BulbapediaLocationPage::fromUrl($args[1]);
            } else {
                $bulbapedia = BulbapediaLocationPage::fromFile(__DIR__ . "/../../../.cache/location.html");
            }

            $trainerFactory = new TrainerFactory();

            $trainers = $trainerFactory->createTrainersFromBulbapediaTrainers(
                $bulbapedia->extractTrainers($args[2] ?? null),
            );

            echo TrainersConfig::fromTrainers($trainers);

        } elseif ($args[0] === "pokemonIds") {
            $bulbapedia = BulbapediaPokedexPage::fromFile(__DIR__ . "/../../../.cache/pokedex.html");

            $pokedexNumberConstantFactory = new PokedexNumberConstantFactory();

            $constants = $pokedexNumberConstantFactory->createPokedexNumberConstantssFromBulbapedia(
                $bulbapedia->extractPokemonIds()
            );

            echo PokedexNoConstants::fromPokedexNumberConstants($constants);

        } elseif ($args[0] === "pokemon") {
            $lowerBound = $args[1] ?? null;
            $upperBound = $args[2] ?? null;

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
        } elseif ($args[0] === "evs") {

            $bulbapedia = BulbapediaEvsPage::fromFile(__DIR__ . "/../../../.cache/evs.html");

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

        } elseif ($args[0] === "check") {

            $pokedex = require __DIR__ . "/../../../src/Config/Pokedex.php";
            $encounters = require __DIR__ . "/../../../src/Config/Encounters/Hoenn.php";

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

            $unencounterablePokemon = [];

            for ($i = 252; $i <= 386; $i++) {
                if (!in_array($i, $encounterablePokedexNumbers)) {
                    $unencounterablePokemon[] = $pokemonByIds[$i];
                }
            }

            dd($unencounterablePokemon);

        } elseif ($args[0] === "sex") {

            $bulbapedia = BulbapediaSexRatiosPage::fromFile(__DIR__ . "/../../../.cache/sex.html");

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
                return $a->pokedexNumber->value > $b->pokedexNumber->value ? 1 : -1;
            });

            echo SexRatiosConfig::fromPokemonSexRatios($sexRatios);

        } elseif ($args[0] === "eggcycles") {
            $bulbapedia = BulbapediaEggCyclesPage::fromFile(__DIR__ . "/../../../.cache/eggcycles.html");

            $eggCycles = [];

            foreach ($bulbapedia->extractEggGroupsAndEggCycles() as $bulbapediaEntry) {
                $eggCycles[] = new PokemonEggCycles(
                    new PokedexNumber(strval(intval($bulbapediaEntry['pokedexNumber']))),
                    intval($bulbapediaEntry['cycles'])
                );
            }

            echo EggCyclesConfig::fromPokemonEggCycles($eggCycles);

        } elseif ($args[0] === "egggroups") {
            $bulbapedia = BulbapediaEggCyclesPage::fromFile(__DIR__ . "/../../../.cache/eggcycles.html");

            $eggGroups = [];

            foreach ($bulbapedia->extractEggGroupsAndEggCycles() as $bulbapediaEntry) {
                $eggGroups[] = PokemonEggGroupsFactory::fromBulbapediaEntry($bulbapediaEntry);
            }

            echo EggGroupsConfig::fromPokemonEggGroups($eggGroups);
        }
    }
}
