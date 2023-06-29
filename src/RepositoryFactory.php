<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Battle\EliteFourChallengeRegionalVictoryQuery;
use ConorSmith\Pokemon\Battle\Repositories\AreaRepository;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\EncounterRepository;
use ConorSmith\Pokemon\Battle\Repositories\LocationRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\Player\EarnedGymBadgesQueryDb;
use ConorSmith\Pokemon\Pokedex\Repositories\PokedexEntryRepository;
use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\TeamPokemonQuery;
use Doctrine\DBAL\Connection;

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
            EliteFourChallengeRepository::class => new EliteFourChallengeRepository($this->db),
            BagRepository::class                => new BagRepository($this->db, $instanceId),
            CaughtPokemonRepository::class      => new CaughtPokemonRepository($this->db, $instanceId),
            LocationRepository::class           => new LocationRepository(
                $this->db,
                new LocationConfigRepository(),
                $instanceId,
            ),
            PlayerRepository::class             => new PlayerRepository(
                $this->db,
                new TeamPokemonQuery($this->create(PokemonRepository::class, $instanceId)),
                require __DIR__ . "/Config/Pokedex.php",
                $instanceId,
            ),
            PokemonRepository::class            => new PokemonRepository(
                $this->db,
                new EarnedGymBadgesQueryDb($this->db, $instanceId),
                new PokemonConfigRepository(),
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
                require __DIR__ . "/Config/Pokedex.php",
                new FoodDiaryHabitStreakQuery(
                    $this->create(DailyHabitLogRepository::class, $instanceId)
                ),
                $instanceId,
            ),
            TrainerRepository::class            => new TrainerRepository(
                $this->db,
                require __DIR__ . "/Config/Pokedex.php",
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                new TrainerConfigRepository(),
                new LocationConfigRepository(),
                $instanceId,
            ),
            AreaRepository::class               => new AreaRepository(
                $this->create(TrainerRepository::class, $instanceId),
                new LocationConfigRepository(),
            ),
        };
    }
}
