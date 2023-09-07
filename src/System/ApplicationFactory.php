<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\EncounterConfigRepository;
use ConorSmith\Pokemon\Location\Controllers\ControllerFactory as LocationControllerFactory;
use ConorSmith\Pokemon\Location\RepositoryFactory as LocationRepositoryFactory;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\FriendshipLogReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\Party\FriendshipLogReportPartyPokemonFaintedCommand;
use ConorSmith\Pokemon\TemplateEngine;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\HttpFoundation\Session\Session;

final class ApplicationFactory
{
    private static Connection $databaseConnection;
    private static Session $sessionManager;

    public static function createHttpKernel(): HttpKernel
    {
        return new HttpKernel(
            self::createControllerFactory(),
            new GameModeMiddleware(self::createDatabaseConnection()),
        );
    }

    public static function createConsoleKernel(): ConsoleKernel
    {
        return new ConsoleKernel();
    }

    private static function createControllerFactory(): ControllerFactory
    {
        return new ControllerFactory(
            new RepositoryFactory(self::createDatabaseConnection()),
            new LocationControllerFactory(
                new LocationRepositoryFactory(
                    self::createDatabaseConnection(),
                    new RepositoryFactory(self::createDatabaseConnection()),
                ),
                self::createDatabaseConnection(),
                new EncounterConfigRepository(),
                new LocationConfigRepository(),
                new TrainerConfigRepository(),
                new ViewModelFactory(self::createPokedexConfigArray()),
                self::createPokedexConfigArray(),
                new TemplateEngine(self::createSessionManager()),
            ),
            self::createDatabaseConnection(),
            self::createSessionManager(),
            new LocationConfigRepository(),
            new TrainerConfigRepository(),
            new FriendshipLog(self::createDatabaseConnection()),
            new ViewModelFactory(self::createPokedexConfigArray()),
            new FriendshipLogReportPartyPokemonFaintedCommand(new FriendshipLog(self::createDatabaseConnection())),
            new FriendshipLogReportBattleWithGymLeaderCommand(new FriendshipLog(self::createDatabaseConnection())),
            self::createPokedexConfigArray(),
            new TemplateEngine(self::createSessionManager()),
        );
    }

    private static function createDatabaseConnection(): Connection
    {
        if (!isset(self::$databaseConnection)) {
            self::$databaseConnection = DriverManager::getConnection([
                'dbname'   => $_ENV['DB_NAME'],
                'user'     => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'host'     => $_ENV['DB_HOST'],
                'driver'   => "pdo_mysql",
            ]);
        }

        return self::$databaseConnection;
    }

    private static function createSessionManager(): Session
    {
        if (!isset(self::$sessionManager)) {
            self::$sessionManager = new Session();
            self::$sessionManager->start();
        }

        return self::$sessionManager;
    }

    private static function createPokedexConfigArray(): array
    {
        return require __DIR__ . "/../Config/Pokedex.php";
    }
}