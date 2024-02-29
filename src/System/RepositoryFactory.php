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
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\Location\Domain\FindFixedEncounters;
use ConorSmith\Pokemon\Location\FindFixedEncountersFixedEncounterQuery;
use ConorSmith\Pokemon\Party\LastTimeFixedEncounterPokemonWasCapturedQuery;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Player\Repositories\GymBadgeRepository;
use ConorSmith\Pokemon\Player\Repositories\GymBadgeRepositoryDb;
use ConorSmith\Pokemon\Pokedex\PokedexRegionIsCompleteQuery;
use ConorSmith\Pokemon\Pokedex\TotalRegisteredPokemonQuery;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery;
use ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository;
use ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository;
use ConorSmith\Pokemon\ItemConfigRepository;
use ConorSmith\Pokemon\Location\Repositories\RegionRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\CapturedPokemonQuery;
use ConorSmith\Pokemon\Party\Domain\GenealogyRepository;
use ConorSmith\Pokemon\Party\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\Party\Repositories\EggRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Party\Repositories\GenealogyRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\FixedEncounterCaptureEventRepositoryDb;
use ConorSmith\Pokemon\Party\Repositories\ObtainedGiftPokemonRepository;
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
        return match ($className) {
            DailyHabitLogRepository::class           => new DailyHabitLogRepository($this->db, $instanceId),
            UnlimitedHabitLogRepository::class       => new UnlimitedHabitLogRepository($this->db, $instanceId),
            WeeklyHabitLogRepository::class          => new WeeklyHabitLogRepository($this->db, $instanceId),
            EliteFourChallengeRepository::class      => new EliteFourChallengeRepository(
                $this->db,
                $this->create(LeagueChampionRepository::class, $instanceId),
                $instanceId,
            ),
            BagRepository::class                     => new BagRepository($this->db, $instanceId),
            CaughtPokemonRepository::class           => new CaughtPokemonRepository($this->db, $instanceId),
            LocationRepository::class                => new LocationRepository(
                $this->db,
                new LocationConfigRepository(),
                $instanceId,
            ),
            PlayerRepositoryDb::class                => new PlayerRepositoryDb(
                $this->db,
                new CapturedPokemonQuery(
                    $this->create(PokemonRepositoryDb::class, $instanceId),
                ),
                require __DIR__ . "/../Config/Pokedex.php",
                new ItemConfigRepository(),
                $instanceId,
            ),
            PokemonRepositoryDb::class               => new PokemonRepositoryDb(
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
            EvolutionRepository::class               => new EvolutionRepository(new PokemonConfigRepository()),
            PokedexEntryRepository::class            => new PokedexEntryRepository(
                $this->db,
                new PokedexConfigRepository(),
                $instanceId,
            ),
            RegionRepository::class                  => new RegionRepository(
                new RegionConfigRepository(),
                new EliteFourChallengeRegionalVictoryQuery(
                    $this->create(EliteFourChallengeRepository::class, $instanceId),
                ),
            ),
            EncounterRepository::class                    => new EncounterRepository(
                $this->db,
                new WildEncounterConfigRepository(),
                new PokedexConfigRepository(),
                new FindFixedEncountersFixedEncounterQuery(
                    new \ConorSmith\Pokemon\Location\Repositories\LocationRepository(
                        $this->db,
                        $this->create(RegionRepository::class, $instanceId),
                        new LocationConfigRepository(),
                        $instanceId,
                    ),
                    new FindFixedEncounters(
                        $this->create(BagRepository::class, $instanceId),
                        new FixedEncounterConfigRepository(),
                        new LocationConfigRepository(),
                        new HighestRankedGymBadgeQueryDb(
                            $this->db,
                            $instanceId,
                        ),
                        new LastTimeFixedEncounterPokemonWasCapturedQuery(
                            $this->create(FixedEncounterCaptureEventRepositoryDb::class, $instanceId),
                        ),
                        new PokedexRegionIsCompleteQuery(
                            $this->db,
                            $instanceId,
                        ),
                        new TotalRegisteredPokemonQuery(
                            $this->create(PokedexEntryRepository::class, $instanceId),
                        ),
                    ),
                ),
                new FoodDiaryHabitStreakQuery(
                    $this->create(DailyHabitLogRepository::class, $instanceId),
                ),
                $instanceId,
            ),
            TrainerRepository::class                 => new TrainerRepository(
                $this->db,
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                new TrainerConfigRepository(),
                new LocationConfigRepository(),
                new PokedexConfigRepository(),
                $instanceId,
            ),
            AreaRepository::class                    => new AreaRepository(
                $this->create(BattleRepository::class, $instanceId),
                $this->create(TrainerRepository::class, $instanceId),
                new LocationConfigRepository(),
            ),
            EggRepositoryDb::class                   => new EggRepositoryDb($this->db, $instanceId),
            GenealogyRepository::class               => new GenealogyRepositoryDb($this->db, $instanceId),
            BattleRepository::class                  => new BattleRepositoryDb(
                $this->db,
                new TrainerConfigRepository(),
                $this->create(EliteFourChallengeRepository::class, $instanceId),
                $this->create(LeagueChampionRepository::class, $instanceId),
                $instanceId,
            ),
            LeagueChampionRepository::class          => new LeagueChampionRepository(
                $this->db,
                $instanceId,
            ),
            ObtainedGiftPokemonRepository::class     => new ObtainedGiftPokemonRepository(
                $this->db,
                $instanceId,
            ),
            FixedEncounterCaptureEventRepositoryDb::class => new FixedEncounterCaptureEventRepositoryDb(
                $this->db,
                $instanceId,
            ),
            GymBadgeRepository::class                => new GymBadgeRepositoryDb(
                $this->db,
                $instanceId,
            ),
            default                                  => throw new LogicException(),
        };
    }
}
