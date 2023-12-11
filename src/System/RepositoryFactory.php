<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\EliteFourChallengeRegionalVictoryQuery;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\BattleRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\CapturedPokemonQuery;
use ConorSmith\Pokemon\Party\Domain\GenealogyRepository;
use ConorSmith\Pokemon\Party\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\Party\Repositories\EggRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Party\Repositories\GenealogyRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Party\Repositories\PokemonRepositoryDb;
use ConorSmith\Pokemon\Player\EarnedGymBadgesQueryDb;
use ConorSmith\Pokemon\Pokedex\EvolutionaryLineQuery;
use ConorSmith\Pokemon\Pokedex\Repositories\EvolutionaryLineRepository;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\RegionConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\TrainerConfigRepository;
use Doctrine\DBAL\Connection;
use LogicException;

final class RepositoryFactory
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function create(string $className, InstanceId $instanceId): mixed
    {
        return match($className) {
            DailyHabitLogRepository::class      => new DailyHabitLogRepository($this->db, $instanceId),
            UnlimitedHabitLogRepository::class  => new UnlimitedHabitLogRepository($this->db, $instanceId),
            WeeklyHabitLogRepository::class     => new WeeklyHabitLogRepository($this->db, $instanceId),
            EliteFourChallengeRepository::class => new EliteFourChallengeRepository(
                $this->db,
                $this->create(LeagueChampionRepository::class, $instanceId),
            ),
            BagRepository::class                => new BagRepository($this->db, $instanceId),
            CaughtPokemonRepository::class      => new CaughtPokemonRepository($this->db, $instanceId),
            LocationRepository::class           => new LocationRepository(
                $this->db,
                new LocationConfigRepository(),
                $instanceId,
            ),
            PlayerRepositoryDb::class           => new PlayerRepositoryDb(
                $this->db,
                new CapturedPokemonQuery(
                    $this->create(PokemonRepositoryDb::class, $instanceId),
                ),
                require __DIR__ . "/../Config/Pokedex.php",
                $instanceId,
            ),
            PokemonRepositoryDb::class          => new PokemonRepositoryDb(
                $this->db,
                new EarnedGymBadgesQueryDb($this->db, $instanceId),
                new EvolutionaryLineQuery(
                    new EvolutionaryLineRepository(
                        new PokedexConfigRepository(),
                    ),
                ),
                new PokedexConfigRepository(),
                new LocationConfigRepository(),
                $instanceId,
            ),
            EvolutionRepository::class          => new EvolutionRepository(new PokemonConfigRepository()),
            PokedexEntryRepository::class       => new PokedexEntryRepository(
                $this->db,
                new PokedexConfigRepository(),
                $instanceId,
            ),
            RegionRepository::class             => new RegionRepository(
                new RegionConfigRepository(),
                new EliteFourChallengeRegionalVictoryQuery(
                    $this->create(EliteFourChallengeRepository::class, $instanceId),
                ),
            ),
            EncounterRepository::class          => new EncounterRepository(
                $this->db,
                new EncounterConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                new FoodDiaryHabitStreakQuery(
                    $this->create(DailyHabitLogRepository::class, $instanceId)
                ),
                $instanceId,
            ),
            TrainerRepository::class            => new TrainerRepository(
                $this->db,
                require __DIR__ . "/../Config/Pokedex.php",
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                new TrainerConfigRepository(),
                new LocationConfigRepository(),
                $instanceId,
            ),
            AreaRepository::class               => new AreaRepository(
                $this->create(BattleRepository::class, $instanceId),
                $this->create(TrainerRepository::class, $instanceId),
                new LocationConfigRepository(),
            ),
            EggRepositoryDb::class              => new EggRepositoryDb($this->db, $instanceId),
            GenealogyRepository::class          => new GenealogyRepositoryDb($this->db, $instanceId),
            BattleRepository::class             => new BattleRepositoryDb(
                $this->db,
                new TrainerConfigRepository(),
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                $instanceId,
            ),
            LeagueChampionRepository::class     => new LeagueChampionRepository(
                $this->db,
                $instanceId,
            ),
            default                             => throw new LogicException(),
        };
    }
}