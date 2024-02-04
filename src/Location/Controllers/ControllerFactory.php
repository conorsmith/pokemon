<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Location\Controllers;

use ConorSmith\Pokemon\Battle\BattleRepositoryAllGymTrainersHaveBeenDefeatedQuery;
use ConorSmith\Pokemon\Battle\BattleRepositoryAreaIsClearedQuery;
use ConorSmith\Pokemon\Battle\BattleRepositoryLastTimeTrainerWasBeatenQuery;
use ConorSmith\Pokemon\Battle\BattleRepositoryTrainerHasBeenBeatenQuery;
use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\EliteFourChallengeRegionalVictoryQuery;
use ConorSmith\Pokemon\Battle\LeagueChampionRepositoryPlayerIsLeagueChampionQuery;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFeatures;
use ConorSmith\Pokemon\Location\Domain\FindFixedEncounters;
use ConorSmith\Pokemon\Location\Domain\FindPokemonLeague;
use ConorSmith\Pokemon\Location\Domain\FindTrainers;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\RepositoryFactory;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\LastTimeLegendaryPokemonWasCapturedQuery;
use ConorSmith\Pokemon\Party\Repositories\LegendaryCaptureEventRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Player\EarnedAllRegionalGymBadgesQueryDb;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Player\NotifyPlayerCommand;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\Pokedex\PokedexRegionIsCompleteQuery;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Commands\NotifyPlayerCommand as NotifyPlayerCommandInterface;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory as SharedViewModelFactory;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use Doctrine\DBAL\Connection;
use Symfony\Component\HttpFoundation\Session\Session;

final class ControllerFactory
{
    public function __construct(
        private readonly RepositoryFactory $repositoryFactory,
        private readonly Connection $db,
        private readonly WildEncounterConfigRepository $wildEncounterConfigRepository,
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
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                new EliteFourConfigRepository(),
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                new EliteFourChallengeRegionalVictoryQuery(
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId)
                ),
                $this->createFindFeatures($instanceId),
                new TemplateEngine(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId,
                    )
                ),
            ),
            GetWildEncounters::class => new GetWildEncounters(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->wildEncounterConfigRepository,
                $this->createFindFeatures($instanceId),
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
            GetTrainers::class => new GetTrainers(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->trainerConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindTrainers($instanceId),
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->sharedViewModelFactory,
                new TemplateEngine(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId,
                    )
                ),
            ),
            GetEliteFour::class => new GetEliteFour(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                new EliteFourConfigRepository(),
                $this->createFindFeatures($instanceId),
                $this->createFindPokemonLeague($instanceId),
                new EarnedAllRegionalGymBadgesQueryDb($this->db, $instanceId),
                new ViewModelFactory(
                    $this->locationConfigRepository,
                ),
                $this->createNotifyPlayerCommand($instanceId),
                new TemplateEngine(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId,
                    )
                ),
            ),
            GetLegendaryEncounters::class => new GetLegendaryEncounters(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->pokedexConfigRepository,
                $this->createFindFixedEncounters($instanceId),
                $this->createFindFeatures($instanceId),
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
            GetGiftPokemon::class => new GetGiftPokemon(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(ObtainedGiftPokemonRepository::class, $instanceId),
                new GiftPokemonConfigRepository(),
                $this->locationConfigRepository,
                $this->pokedexConfigRepository,
                $this->createFindFeatures($instanceId),
                new BattleRepositoryAreaIsClearedQuery(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->locationConfigRepository,
                ),
                new HighestRankedGymBadgeQueryDb(
                    $this->db,
                    $instanceId,
                ),
                new EliteFourChallengeRegionalVictoryQuery(
                    $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId)
                ),
                new BattleRepositoryTrainerHasBeenBeatenQuery(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                ),
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

    private function createFindFixedEncounters(InstanceId $instanceId): FindFixedEncounters
    {
        return new FindFixedEncounters(
            $this->repositoryFactory->create(BagRepository::class, $instanceId),
            $this->locationConfigRepository,
            new HighestRankedGymBadgeQueryDb(
                $this->db,
                $instanceId,
            ),
            new LastTimeLegendaryPokemonWasCapturedQuery(
                $this->repositoryFactory->create(LegendaryCaptureEventRepositoryDb::class, $instanceId),
            ),
            new PokedexRegionIsCompleteQuery(
                $this->db,
                $instanceId,
            ),
            new TotalRegisteredPokemonQuery(
                $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
            ),
        );
    }

    private function createFindTrainers(InstanceId $instanceId): FindTrainers
    {
        return new FindTrainers(
            $this->repositoryFactory->create(BagRepository::class, $instanceId),
            $this->trainerConfigRepository,
            new BattleRepositoryAllGymTrainersHaveBeenDefeatedQuery(
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                $this->trainerConfigRepository,
            ),
            new BattleRepositoryLastTimeTrainerWasBeatenQuery(
                $this->repositoryFactory->create(BattleRepository::class, $instanceId),
            ),
            new LeagueChampionRepositoryPlayerIsLeagueChampionQuery(
                $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
            ),
            new EliteFourChallengeRegionalVictoryQuery(
                $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId)
            ),
        );
    }

    private function createFindPokemonLeague(InstanceId $instanceId): FindPokemonLeague
    {
        return new FindPokemonLeague(
            new EliteFourConfigRepository(),
            new LeagueChampionRepositoryPlayerIsLeagueChampionQuery(
                $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
            )
        );
    }

    private function createFindFeatures(InstanceId $instanceId): FindFeatures
    {
        return new FindFeatures(
            $this->wildEncounterConfigRepository,
            new GiftPokemonConfigRepository(),
            $this->locationConfigRepository,
            $this->createFindFixedEncounters($instanceId),
            $this->createFindPokemonLeague($instanceId),
            $this->createFindTrainers($instanceId),
        );
    }

    private function createNotifyPlayerCommand(InstanceId $instanceId): NotifyPlayerCommandInterface
    {
        return new NotifyPlayerCommand(
            new NotificationRepositoryDbAndSession(
                $this->db,
                $this->session,
                $instanceId,
            ),
        );
    }
}
