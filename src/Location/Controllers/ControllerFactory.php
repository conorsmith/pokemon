<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\RegionalVictoryQuery;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use Doctrine\DBAL\Connection;

final class ControllerFactory
{
    public function __construct(
        private readonly Connection $db,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly EliteFourChallengeRepository $eliteFourChallengeRepository,
        private readonly BagRepository $bagRepository,
        private readonly RegionalVictoryQuery $regionalVictoryQuery,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function create(string $className): mixed
    {
        return match ($className) {
            default => null,
            GetMap::class => new GetMap(
                $this->db,
                new LocationRepository(
                    $this->db,
                    $this->regionalVictoryQuery,
                    $this->locationConfigRepository,
                ),
                $this->bagRepository,
                $this->eliteFourChallengeRepository,
                $this->locationConfigRepository,
                $this->encounterConfigRepository,
                $this->trainerConfigRepository,
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->sharedViewModelFactory,
                new TotalRegisteredPokemonQuery(
                    new PokedexEntryRepository(
                        $this->db,
                        new PokedexConfigRepository()
                    ),
                ),
                $this->pokedex,
                $this->templateEngine,
            ),
            GetTrackPokemon::class => new GetTrackPokemon(
                new LocationRepository(
                    $this->db,
                    $this->regionalVictoryQuery,
                    $this->locationConfigRepository,
                ),
                $this->bagRepository,
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->templateEngine,
            ),
        };
    }
}