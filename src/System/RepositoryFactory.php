<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\AreaRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EncounterRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LocationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\AreaRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\BattleRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EliteFourChallengeRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EncounterRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\LeagueChampionRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\BattleLocationRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\TrainerRepositoryDb;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Evolution\EvolutionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\FixedEncounterCaptureEventRepository;
use ConorSmith\Pokemon\Gameplay\Domain\InGameEvents\ObtainedGiftPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\FindFixedEncounters;
use ConorSmith\Pokemon\Gameplay\Domain\LocationFeatures\RegionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Notifications\NotificationRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\CaughtPokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\PokemonRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Pokedex\PokedexEntryRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Surveying\SurveyRepository;
use ConorSmith\Pokemon\Gameplay\Domain\GymBadgeRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\FriendshipEventLogRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\GymBadgeRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\SurveyRepositoryDb;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\RegionRepositoryConfig;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Breeding\GenealogyRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\CaughtPokemonRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EggRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EvolutionRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\GenealogyRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\FixedEncounterCaptureEventRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\ObtainedGiftPokemonRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EvolutionaryLineRepositoryConfig;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\PokedexEntryRepositoryDb;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\RegionConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Doctrine\DBAL\Connection;
use LogicException;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;

final class RepositoryFactory
{
    public function __construct(
        private readonly Connection $db,
        private readonly FlashBagAwareSessionInterface $session,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match ($className) {
            DailyHabitLogRepository::class      => new DailyHabitLogRepository($this->db, $instanceId),
            UnlimitedHabitLogRepository::class  => new UnlimitedHabitLogRepository($this->db, $instanceId),
            WeeklyHabitLogRepository::class     => new WeeklyHabitLogRepository($this->db, $instanceId),
            EliteFourChallengeRepository::class => new EliteFourChallengeRepositoryDb(
                $this->db,
                $this->create(LeagueChampionRepository::class, $instanceId),
                $instanceId,
            ),
            BagRepository::class                => new BagRepository($this->db, $instanceId),
            CaughtPokemonRepository::class      => new CaughtPokemonRepositoryDb($this->db, $instanceId),
            LocationRepository::class => new BattleLocationRepositoryDb(
                $this->db,
                new LocationConfigRepository(),
                $instanceId,
            ),
            PlayerRepository::class             => new PlayerRepositoryDb(
                $this->db,
                $this->create(PokemonRepository::class, $instanceId),
                require __DIR__ . "/../Config/Pokedex.php",
                new ItemConfigRepository(),
                $instanceId,
            ),
            PokemonRepository::class      => new PokemonRepositoryDb(
                $this->db,
                new EvolutionaryLineRepositoryConfig(
                    new PokedexConfigRepository(),
                ),
                $this->create(FriendshipEventLogRepository::class, $instanceId),
                $this->create(GymBadgeRepository::class, $instanceId),
                new PokedexConfigRepository(),
                new LocationConfigRepository(),
                $instanceId,
            ),
            EvolutionRepository::class    => new EvolutionRepositoryDb(
                new PokedexConfigRepository(),
            ),
            PokedexEntryRepository::class => new PokedexEntryRepositoryDb(
                $this->db,
                new PokedexConfigRepository(),
                $instanceId,
            ),
            RegionRepository::class               => new RegionRepositoryConfig(
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                new RegionConfigRepository(),
            ),
            EncounterRepository::class                                               => new EncounterRepositoryDb(
                $this->db,
                $this->create(\ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class, $instanceId),
                new FindFixedEncounters(
                    $this->create(BagRepository::class, $instanceId),
                    $this->create(FixedEncounterCaptureEventRepository::class, $instanceId),
                    $this->create(GymBadgeRepository::class, $instanceId),
                    $this->create(PokedexEntryRepository::class, $instanceId),
                    new FixedEncounterConfigRepository(),
                    new PokedexConfigRepository(),
                    new LocationConfigRepository(),
                ),
                new WildEncounterConfigRepository(),
                new PokedexConfigRepository(),
                new FoodDiaryHabitStreakQuery(
                    $this->create(DailyHabitLogRepository::class, $instanceId),
                ),
                $instanceId,
            ),
            TrainerRepository::class => new TrainerRepositoryDb(
                $this->db,
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                new TrainerConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                $instanceId,
            ),
            AreaRepository::class      => new AreaRepositoryDb(
                $this->create(BattleRepository::class, $instanceId),
                $this->create(TrainerRepository::class, $instanceId),
                new LocationConfigRepository(),
            ),
            EggRepositoryDb::class                   => new EggRepositoryDb($this->db, $instanceId),
            GenealogyRepository::class               => new GenealogyRepositoryDb($this->db, $instanceId),
            BattleRepository::class             => new BattleRepositoryDb(
                $this->db,
                new TrainerConfigRepository(),
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                $instanceId,
            ),
            LeagueChampionRepository::class   => new LeagueChampionRepositoryDb(
                $this->db,
                $instanceId,
            ),
            ObtainedGiftPokemonRepository::class => new ObtainedGiftPokemonRepositoryDb(
                $this->db,
                $instanceId,
            ),
            FixedEncounterCaptureEventRepository::class => new FixedEncounterCaptureEventRepositoryDb(
                $this->db,
                $instanceId,
            ),
            GymBadgeRepository::class                => new GymBadgeRepositoryDb(
                $this->db,
                $instanceId,
            ),
            \ConorSmith\Pokemon\Gameplay\Domain\Navigation\LocationRepository::class => new \ConorSmith\Pokemon\Gameplay\Infra\Repositories\NavigationLocationRepositoryDb(
                $this->db,
                $this->create(RegionRepository::class, $instanceId),
                new LocationConfigRepository(),
                $instanceId,
            ),
            SurveyRepository::class   => new SurveyRepositoryDb(
                $this->db,
                $instanceId,
            ),
            NotificationRepository::class => new NotificationRepositoryDbAndSession(
                $this->db,
                $this->session,
                $instanceId,
            ),
            FriendshipEventLogRepository::class => new FriendshipEventLogRepositoryDb(
                $this->db,
                new PokedexConfigRepository(),
                $instanceId,
            ),
            default                                  => throw new LogicException(),
        };
    }
}
