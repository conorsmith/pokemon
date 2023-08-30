<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Battle\EliteFourChallengeRegionalVictoryQuery;
use ConorSmith\Pokemon\Battle\LeagueChampionRepositoryPlayerIsLeagueChampionQuery;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Controllers\GetMap;
use ConorSmith\Pokemon\Controllers\GetTrackPokemon;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\RepositoryFactory;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use Doctrine\DBAL\Connection;

final class ControllerFactory
{
    public function __construct(
        private readonly RepositoryFactory $repositoryFactory,
        private readonly Connection $db,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly array $pokedex,
        private readonly TemplateEngine $templateEngine,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            default => null,
            GetMap::class => new GetMap(
                $this->db,
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->encounterConfigRepository,
                $this->trainerConfigRepository,
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->sharedViewModelFactory,
                new TotalRegisteredPokemonQuery(
                    $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                ),
                new LeagueChampionRepositoryPlayerIsLeagueChampionQuery(
                    $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
                ),
                new EliteFourChallengeRegionalVictoryQuery(
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId)
                ),
                $this->pokedex,
                $this->templateEngine,
            ),
            GetTrackPokemon::class => new GetTrackPokemon(
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->templateEngine,
            ),
        };
    }
}
