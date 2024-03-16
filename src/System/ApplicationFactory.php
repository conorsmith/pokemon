<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\EliteFourConfigRepository;
use ConorSmith\Pokemon\FixedEncounterConfigRepository;
use ConorSmith\Pokemon\GiftPokemonConfigRepository;
use ConorSmith\Pokemon\WildEncounterConfigRepository;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
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
            new RepositoryFactory(self::createDatabaseConnection(), self::createSessionManager()),
            self::createDatabaseConnection(),
            new EliteFourConfigRepository(),
            new FixedEncounterConfigRepository(),
            new GiftPokemonConfigRepository(),
            new LocationConfigRepository(),
            new TrainerConfigRepository(),
            new PokedexConfigRepository(),
            new WildEncounterConfigRepository(),
            new ViewModelFactory(
                new PokedexConfigRepository(),
            ),
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
}
