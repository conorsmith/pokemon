<?php
declare(strict_types=1);

namespace ConorSmith\PokemonTest\Support;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Schema\Table;
use Phinx\Console\PhinxApplication;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;

final class Database
{
    private static ?Connection $databaseConnection = null;

    public static function setup(): void
    {
        $db = self::createDatabaseConnection();

        $schemaManager = $db->createSchemaManager();

        /** @var Table $table */
        foreach ($schemaManager->listTables() as $table) {
            $schemaManager->dropTable($table->getName());
        }

        $app = new PhinxApplication();
        $app->setAutoExit(false);
        $app->run(new StringInput('migrate'), new NullOutput());
    }

    public static function createDatabaseConnection(): Connection
    {
        if (is_null(self::$databaseConnection)) {
            self::$databaseConnection = DriverManager::getConnection([
                'dbname'   => $_ENV['DB_NAME'],
                'user'     => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'host'     => "localhost",
                'driver'   => "pdo_mysql",
            ]);
        }

        return self::$databaseConnection;
    }
}
