<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\Controllers;

use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\RegionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokemonEntry;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Pokedex\ViewModels\PokemonEntryVm;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\TemplateEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokedex
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly RegionRepository $regionRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
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
                $viewModels[intval($entry->pokedexNumber)] = PokemonEntryVm::create($entry, $config);
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

        $regionMenu = [];

        foreach (include __DIR__ . "/../../../../../Config/Regions.php" as $regionConfig) {
            $region = $this->regionRepository->find($regionConfig['id']);
            if (!$region->isLocked) {
                $regionMenu[$regionConfig['id']->value] = $regionConfig['name'];
            }
        }

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/List.php", [
            'count'      => $count,
            'pokedex'    => $viewModels,
            'regionMenu' => $regionMenu,
        ]));
    }
}
