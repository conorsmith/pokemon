<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ConsoleCommands;

use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\SimulateABattle;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\PokemonTest\Support\Instance;
use Doctrine\DBAL\DriverManager;

final class Simulate
{
    public function __invoke(array $args): void
    {
        $db = DriverManager::getConnection([
            'dbname'   => $_ENV['DB_NAME'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host'     => $_ENV['DB_HOST'],
            'driver'   => "pdo_mysql",
        ]);

        $useCase = new SimulateABattle(
            new TrainerRepository(
                $db,
                require __DIR__ . "/../../../src/Config/Pokedex.php",
                new EliteFourChallengeRepository(
                    $db,
                    new LeagueChampionRepository(
                        $db,
                        new InstanceId(Instance::DEFAULT_ID),
                    ),
                ),
                new LeagueChampionRepository(
                    $db,
                    new InstanceId(Instance::DEFAULT_ID),
                ),
                new TrainerConfigRepository(),
                new LocationConfigRepository(),
                new InstanceId(Instance::DEFAULT_ID),
            ),
            new EventFactory(
                new ViewModelFactory(require __DIR__ . "/../../../src/Config/Pokedex.php"),
                new PokedexConfigRepository(),
            ),
            require __DIR__ . "/../../../src/Config/Pokedex.php",
        );

        $result = $useCase->run($args[0] ?? null, $args[1] ?? null);

        if ($result->wasDraw) {
            echo "It's a draw!" . PHP_EOL;

        } else {
            echo "The winner is " . TrainerClass::getLabel($result->getWinningTrainer()->class) . " " . $result->getWinningTrainer()->name . PHP_EOL;
        }
    }
}
