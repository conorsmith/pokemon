<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Controllers;

use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\ViewModelFactory;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\TemplateEngine;

final class GetPokedex
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(): void
    {
        $entries = $this->pokedexEntryRepository->all();

        $lastRegisteredEntryNumber = 0;

        /** @var PokemonEntry $entry */
        foreach ($entries as $entry) {
            if ($entry->isRegistered) {
                $lastRegisteredEntryNumber = intval($entry->pokedexNumber);
            }
        }

        /** @var PokemonEntry $entry */
        foreach ($entries as $key => $entry) {
            if (intval($entry->pokedexNumber) > $lastRegisteredEntryNumber) {
                unset($entries[$key]);
            }
        }

        $viewModels = [];
        $count = 0;

        /** @var PokemonEntry $entry */
        foreach ($entries as $entry) {
            if ($entry->isRegistered) {
                $count++;
                $config = $this->pokedexConfigRepository->find($entry->pokedexNumber);
                $viewModels[intval($entry->pokedexNumber)] = ViewModelFactory::createPokemonViewModel($entry, $config);
            }
        }

        $finalEntry = $this->pokedexEntryRepository->getFinalEntry();
        $configuredPokemonNumbers = range(1, $finalEntry->pokedexNumber);

        for ($i = 1; $i <= $lastRegisteredEntryNumber; $i++) {
            if (!array_key_exists($i, $viewModels)) {
                $viewModels[$i] = null;
            }
        }

        ksort($viewModels);

        $entryNumbersToRemove = [];

        foreach ($configuredPokemonNumbers as $i => $number) {
            if ($number < 4 || $number > $lastRegisteredEntryNumber - 3) {
                continue;
            }

            if (is_null($viewModels[$configuredPokemonNumbers[$i]])
                && is_null($viewModels[$configuredPokemonNumbers[$i - 1]])
                && is_null($viewModels[$configuredPokemonNumbers[$i - 2]])
                && is_null($viewModels[$configuredPokemonNumbers[$i - 3]])
                && is_null($viewModels[$configuredPokemonNumbers[$i + 1]])
                && is_null($viewModels[$configuredPokemonNumbers[$i + 2]])
                && is_null($viewModels[$configuredPokemonNumbers[$i + 3]])
            ) {
                $entryNumbersToRemove[] = $configuredPokemonNumbers[$i];
            }
        }

        foreach ($viewModels as $number => $viewModel) {
            if (in_array($number, $entryNumbersToRemove)) {
                unset($viewModels[$number]);
            }
        }

        echo $this->templateEngine->render(__DIR__ . "/../Templates/List.php", [
            'count' => $count,
            'pokedex' => $viewModels,
        ]);
    }
}