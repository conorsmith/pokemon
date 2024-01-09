<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Battle\EliteFourChallengeRegionalVictoryQuery;
use ConorSmith\Pokemon\Battle\LeagueChampionRepositoryPlayerIsLeagueChampionQuery;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\RepositoryFactory;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class ControllerFactory
{
    public function __construct(
        private readonly RepositoryFactory $repositoryFactory,
        private readonly Connection $db,
        private readonly EncounterConfigRepository $encounterConfigRepository,
        private readonly LocationConfigRepository $locationConfigRepository,
        private readonly TrainerConfigRepository $trainerConfigRepository,
        private readonly PokedexConfigRepository $pokedexConfigRepository,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly Session $session,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            default                => null,
            GetMap::class          => new GetMap(
                $this->db,
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->encounterConfigRepository,
                $this->trainerConfigRepository,
                $this->pokedexConfigRepository,
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
                new TemplateEngine(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId,
                    )
                ),
            ),
            GetTrackPokemon::class => new GetTrackPokemon(
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                new TemplateEngine(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId,
                    )
                ),
            ),
        };
    }
}
