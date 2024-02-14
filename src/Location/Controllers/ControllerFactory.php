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
use ConorSmith\Pokemon\Location\Domain\FindWildEncounters;
use ConorSmith\Pokemon\Location\Domain\SurveyRepository;
use ConorSmith\Pokemon\Location\Repositories\LocationRepository;
use ConorSmith\Pokemon\Location\RepositoryFactory;
use ConorSmith\Pokemon\Location\UseCase\FinishSurveyingPokemon;
use ConorSmith\Pokemon\Location\UseCase\ShowActiveSurvey;
use ConorSmith\Pokemon\Location\UseCase\ShowSurveyRecord;
use ConorSmith\Pokemon\Location\UseCase\StartSurveyingPokemon;
use ConorSmith\Pokemon\Location\ViewModels\ViewModelFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\LastTimeLegendaryPokemonWasCapturedQuery;
use ConorSmith\Pokemon\Party\Repositories\LegendaryCaptureEventRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Player\EarnedAllRegionalGymBadgesQueryDb;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Player\NotifyPlayerCommand;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\Pokedex\PokedexEntryRepositoryPokemonIsRegisteredQuery;
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
        private readonly EliteFourConfigRepository $eliteFourConfigRepository,
        private readonly GiftPokemonConfigRepository $giftPokemonConfigRepository,
        private readonly SharedViewModelFactory $sharedViewModelFactory,
        private readonly Session $session,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            default                => null,
            GetMap::class          => new GetMap(
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->eliteFourConfigRepository,
                $this->createViewModelFactory(),
                $this->createEliteFourChallengeRegionalVictoryQuery($instanceId),
                $this->createFindFeatures($instanceId),
                $this->createFindTrainers($instanceId),
                $this->createFindWildEncounters(),
                $this->createTemplateEngine($instanceId),
            ),
            GetWildEncounters::class => new GetWildEncounters(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(ObtainedGiftPokemonRepository::class, $instanceId),
                $this->giftPokemonConfigRepository,
                $this->locationConfigRepository,
                $this->pokedexConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindWildEncounters(),
                new BattleRepositoryAreaIsClearedQuery(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                    $this->locationConfigRepository,
                ),
                $this->createHighestRankedGymBadgeQuery($instanceId),
                $this->createEliteFourChallengeRegionalVictoryQuery($instanceId),
                new BattleRepositoryTrainerHasBeenBeatenQuery(
                    $this->repositoryFactory->create(BattleRepository::class, $instanceId),
                ),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
            ),
            GetTrainers::class => new GetTrainers(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->trainerConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindTrainers($instanceId),
                $this->createViewModelFactory(),
                $this->sharedViewModelFactory,
                $this->createTemplateEngine($instanceId),
            ),
            GetEliteFour::class => new GetEliteFour(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->eliteFourConfigRepository,
                $this->createFindFeatures($instanceId),
                $this->createFindPokemonLeague($instanceId),
                new EarnedAllRegionalGymBadgesQueryDb($this->db, $instanceId),
                $this->createViewModelFactory(),
                $this->createNotifyPlayerCommand($instanceId),
                $this->createTemplateEngine($instanceId),
            ),
            GetLegendaryEncounters::class => new GetLegendaryEncounters(
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->locationConfigRepository,
                $this->pokedexConfigRepository,
                $this->createFindFixedEncounters($instanceId),
                $this->createFindFeatures($instanceId),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
            ),
            GetTrackPokemon::class => new GetTrackPokemon(
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                $this->repositoryFactory->create(BagRepository::class, $instanceId),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
            ),
            GetSurveyPokemon::class => new GetSurveyPokemon(
                $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                new ShowActiveSurvey(
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                ),
                new ShowSurveyRecord(
                    $this->pokedexConfigRepository,
                    $this->wildEncounterConfigRepository,
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                    new PokedexEntryRepositoryPokemonIsRegisteredQuery(
                        $this->repositoryFactory->create(PokedexEntryRepository::class, $instanceId),
                    ),
                ),
                $this->createViewModelFactory(),
                $this->createTemplateEngine($instanceId),
                new NotifyPlayerCommand(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId
                    ),
                ),
            ),
            PostSurveyPokemonStart::class => new PostSurveyPokemonStart(
                new StartSurveyingPokemon(
                    $this->repositoryFactory->create(LocationRepository::class, $instanceId),
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                    $this->createFindWildEncounters(),
                ),
                new NotifyPlayerCommand(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId
                    ),
                ),
            ),
            PostSurveyPokemonFinish::class => new PostSurveyPokemonFinish(
                new FinishSurveyingPokemon(
                    $this->wildEncounterConfigRepository,
                    $this->repositoryFactory->create(SurveyRepository::class, $instanceId),
                ),
                new NotifyPlayerCommand(
                    new NotificationRepositoryDbAndSession(
                        $this->db,
                        $this->session,
                        $instanceId
                    ),
                ),
            ),
        };
    }

    private function createViewModelFactory(): ViewModelFactory
    {
        return new ViewModelFactory(
            $this->locationConfigRepository,
        );
    }

    private function createTemplateEngine(InstanceId $instanceId): TemplateEngine
    {
        return new TemplateEngine(
            new NotificationRepositoryDbAndSession(
                $this->db,
                $this->session,
                $instanceId,
            ),
        );
    }

    private function createFindWildEncounters(): FindWildEncounters
    {
        return new FindWildEncounters(
            $this->wildEncounterConfigRepository
        );
    }

    private function createFindFixedEncounters(InstanceId $instanceId): FindFixedEncounters
    {
        return new FindFixedEncounters(
            $this->repositoryFactory->create(BagRepository::class, $instanceId),
            $this->locationConfigRepository,
            $this->createHighestRankedGymBadgeQuery($instanceId),
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
            $this->createPlayerIsLeagueChampionQuery($instanceId),
            $this->createEliteFourChallengeRegionalVictoryQuery($instanceId),
        );
    }

    private function createFindPokemonLeague(InstanceId $instanceId): FindPokemonLeague
    {
        return new FindPokemonLeague(
            $this->eliteFourConfigRepository,
            $this->createPlayerIsLeagueChampionQuery($instanceId)
        );
    }

    private function createFindFeatures(InstanceId $instanceId): FindFeatures
    {
        return new FindFeatures(
            $this->wildEncounterConfigRepository,
            $this->giftPokemonConfigRepository,
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

    private function createEliteFourChallengeRegionalVictoryQuery(
        InstanceId $instanceId
    ): EliteFourChallengeRegionalVictoryQuery {
        return new EliteFourChallengeRegionalVictoryQuery(
            $this->repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId)
        );
    }

    private function createHighestRankedGymBadgeQuery(InstanceId $instanceId): HighestRankedGymBadgeQueryDb
    {
        return new HighestRankedGymBadgeQueryDb(
            $this->db,
            $instanceId,
        );
    }

    private function createPlayerIsLeagueChampionQuery(
        InstanceId $instanceId
    ): LeagueChampionRepositoryPlayerIsLeagueChampionQuery {
        return new LeagueChampionRepositoryPlayerIsLeagueChampionQuery(
            $this->repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
        );
    }
}
