<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Pokedex\Controllers;

use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\EncounterType;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Pokedex\Domain\EncounterLocation;
use ConorSmith\Pokemon\Pokedex\Domain\PokemonEntry;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\ViewModelFactory;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\RegionIsLockedQuery;
use ConorSmith\Pokemon\TemplateEngine;
use stdClass;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class GetPokedexEntry
{
    public function __construct(
        private readonly PokedexEntryRepository $pokedexEntryRepository,
        private readonly RegionIsLockedQuery $regionIsLockedQuery,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function __invoke(Request $request, array $args): Response
    {
        $pokedexNumber = $args['number'];

        $entry = $this->pokedexEntryRepository->find($pokedexNumber);

        if (!$entry->isRegistered) {
            return new RedirectResponse("/{$args['instanceId']}/pokedex");
        }

        $config = $this->pokedexConfigRepository->find($entry->pokedexNumber);

        $encounterLocations = $this->findEncounterLocations($entry);

        return new Response($this->templateEngine->render(__DIR__ . "/../Templates/Entry.php", [
            'pokemon'            => ViewModelFactory::createPokemonViewModel($entry, $config),
            'encounterLocations' => array_map(
                fn(EncounterLocation $encounterLocation) => self::createEncounterLocationViewModel(
                    $encounterLocation,
                    $this->locationConfigRepository->findLocation($encounterLocation->locationId),
                ),
                $encounterLocations,
            )
        ]));
    }

    private function findEncounterLocations(PokemonEntry $entry): array
    {
        $entryPokedexNumber = intval($entry->pokedexNumber);

        $locations = [];

        foreach ($this->encounterConfigRepository->allByRegion() as $region => $regionEncountersConfig) {
            if ($this->regionIsLockedQuery->run($region)) {
                continue;
            }
            foreach ($regionEncountersConfig as $locationId => $locationEncountersConfig) {
                foreach ($locationEncountersConfig as $encounterType => $encountersConfig) {
                    $totalWeight = array_reduce(
                        $encountersConfig,
                        fn(int $carry, array $config) => !isset($config['weight'])
                            ? array_reduce(
                                $config,
                                fn(int $carry, array $config) => $carry + $config['weight'],
                                0,
                            )
                            : $carry + $config['weight'],
                        0
                    );
                    foreach ($encountersConfig as $encounterPokedexNumber => $config) {
                        if ($encounterPokedexNumber === $entryPokedexNumber) {
                            $weight = !isset($config['weight'])
                                ? array_reduce(
                                    $config,
                                    fn(int $carry, array $config) => $carry + $config['weight'],
                                    0,
                                )
                                : $config['weight'];

                            $locations[] = new EncounterLocation(
                                $locationId,
                                $region,
                                $encounterType,
                                $weight / $totalWeight,
                            );
                        }
                    }
                }
            }
        }

        return $locations;
    }

    private static function createEncounterLocationViewModel(
        EncounterLocation $encounterLocation,
        array $locationConfig,
    ): stdClass {
        return (object) [
            'name' => $locationConfig['name'],
            'section' => $locationConfig['section'] ?? "",
            'region' => match ($encounterLocation->region) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
            },
            'encounterTypeIcon' => match ($encounterLocation->encounterType) {
                EncounterType::WALKING => "fas fa-shoe-prints",
                EncounterType::SURFING => "fas fa-water",
                EncounterType::FISHING => "fas fa-fish",
                EncounterType::ROCK_SMASH => "fab fa-sith",
            },
            'rarityIcons' => match (true) {
                $encounterLocation->rarity > 0.15 => 3,
                $encounterLocation->rarity > 0.05 => 2,
                default => 1,
            },
        ];
    }
}
