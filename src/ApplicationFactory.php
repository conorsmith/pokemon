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
use ConorSmith\Pokemon\Location\Controllers\ControllerFactory as LocationControllerFactory;
use ConorSmith\Pokemon\Player\EarnedGymBadgesQueryDb;
use ConorSmith\Pokemon\Player\HighestRankedGymBadgeQueryDb;
use ConorSmith\Pokemon\Repositories\CaughtPokemonRepository;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\Team\CatchPokemonCommand;
use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\FriendshipLogReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\Team\FriendshipLogReportTeamPokemonFaintedCommand;
use ConorSmith\Pokemon\Team\LevelUpPokemon;
use ConorSmith\Pokemon\Team\Repositories\EvolutionRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonConfigRepository;
use ConorSmith\Pokemon\Team\Repositories\PokemonRepository;
use ConorSmith\Pokemon\Team\TeamPokemonQuery;
use ConorSmith\Pokemon\Team\WeeklyUpdateForTeamCommand;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\HttpFoundation\Session\Session;

final class ApplicationFactory
{
    /** @var Connection */
    private static $databaseConnection;

    /** @var Session */
    private static $sessionManager;

    public static function createHttpKernel(): HttpKernel
    {
        return new HttpKernel(
            self::createControllerFactory(),
            new GameModeMiddleware(self::createDatabaseConnection()),
        );
    }

    private static function createControllerFactory(): ControllerFactory
    {
        return new ControllerFactory(
            new LocationControllerFactory(
                self::createDatabaseConnection(),
                new EncounterConfigRepository(),
                new LocationConfigRepository(),
                new TrainerConfigRepository(),
                new EliteFourChallengeRepository(self::createDatabaseConnection()),
                new BagRepository(self::createDatabaseConnection()),
                new EliteFourChallengeRegionalVictoryQuery(
                    new EliteFourChallengeRepository(self::createDatabaseConnection())
                ),
                new ViewModelFactory(self::createPokedexConfigArray()),
                self::createPokedexConfigArray(),
                new TemplateEngine(self::createSessionManager()),
            ),
            self::createDatabaseConnection(),
            self::createSessionManager(),
            new CaughtPokemonRepository(self::createDatabaseConnection()),
            new LocationConfigRepository(),
            new TrainerConfigRepository(),
            new EncounterRepository(
                self::createDatabaseConnection(),
                new EncounterConfigRepository(),
                new LocationConfigRepository(),
                self::createPokedexConfigArray(),
                new FoodDiaryHabitStreakQuery(self::createDailyHabitLogRepository()),
            ),
            new LocationRepository(
                self::createDatabaseConnection(),
                new LocationConfigRepository(),
            ),
            self::createTrainerRepository(),
            new PlayerRepository(
                self::createDatabaseConnection(),
                new TeamPokemonQuery(self::createPokemonRepository()),
                self::createPokedexConfigArray(),
            ),
            new EliteFourChallengeRepository(self::createDatabaseConnection()),
            new AreaRepository(
                self::createTrainerRepository(),
                new LocationConfigRepository(),
            ),
            new BagRepository(self::createDatabaseConnection()),
            self::createDailyHabitLogRepository(),
            new UnlimitedHabitLogRepository(self::createDatabaseConnection()),
            new WeeklyHabitLogRepository(self::createDatabaseConnection()),
            self::createPokemonRepository(),
            self::createFriendshipLog(),
            new ViewModelFactory(self::createPokedexConfigArray()),
            new CatchPokemonCommand(
                self::createDatabaseConnection(),
                self::createFriendshipLog(),
                self::createPokemonConfigRepository(),
                new LocationConfigRepository(),
            ),
            new FriendshipLogReportTeamPokemonFaintedCommand(self::createFriendshipLog()),
            new FriendshipLogReportBattleWithGymLeaderCommand(self::createFriendshipLog()),
            new WeeklyUpdateForTeamCommand(
                self::createSessionManager(),
                self::createPokemonRepository(),
                self::createLevelUpPokemon(),
                new PokedexConfigRepository(),
            ),
            self::createLevelUpPokemon(),
            self::createPokedexConfigArray(),
            new TemplateEngine(self::createSessionManager()),
        );
    }

    private static function createDatabaseConnection(): Connection
    {
        if (is_null(self::$databaseConnection)) {
            self::$databaseConnection = DriverManager::getConnection([
                'dbname'   => "pokemon",
                'user'     => "pokemon",
                'password' => "password",
                'host'     => "localhost",
                'driver'   => "pdo_mysql",
            ]);
        }

        return self::$databaseConnection;
    }

    private static function createSessionManager(): Session
    {
        if (is_null(self::$sessionManager)) {
            self::$sessionManager = new Session();
            self::$sessionManager->start();
        }

        return self::$sessionManager;
    }

    private static function createPokedexConfigArray(): array
    {
        return require __DIR__ . "/Config/Pokedex.php";
    }

    private static function createDailyHabitLogRepository(): DailyHabitLogRepository
    {
        return new DailyHabitLogRepository(self::createDatabaseConnection());
    }

    private static function createTrainerRepository(): TrainerRepository
    {
        return new TrainerRepository(
            self::createDatabaseConnection(),
            self::createPokedexConfigArray(),
            new EliteFourChallengeRepository(self::createDatabaseConnection()),
            new TrainerConfigRepository(),
            new LocationConfigRepository(),
        );
    }

    private static function createPokemonRepository(): PokemonRepository
    {
        return new PokemonRepository(
            self::createDatabaseConnection(),
            new EarnedGymBadgesQueryDb(self::createDatabaseConnection()),
            self::createPokemonConfigRepository(),
            new LocationConfigRepository(),
        );
    }

    private static function createFriendshipLog(): FriendshipLog
    {
        return new FriendshipLog(self::createDatabaseConnection());
    }

    private static function createPokemonConfigRepository(): PokemonConfigRepository
    {
        return new PokemonConfigRepository();
    }

    private static function createLevelUpPokemon(): LevelUpPokemon
    {
        return new LevelUpPokemon(
            self::createDatabaseConnection(),
            self::createPokemonRepository(),
            new EvolutionRepository(
                new PokemonConfigRepository(),
            ),
            self::createFriendshipLog(),
            new HighestRankedGymBadgeQueryDb(
                self::createDatabaseConnection(),
            ),
        );
    }
}