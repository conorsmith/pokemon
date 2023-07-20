<?php
declare(strict_types=1);

use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\SimulateABattle;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\PokemonTest\Support\Instance;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . "/vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->load();

if ($argc < 3) {
    echo PHP_EOL;
    echo "[ USAGE ]" . PHP_EOL;
    echo "php simulate.php (trainerAId) (trainerBId)" . PHP_EOL . PHP_EOL;
    exit;
}

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
        require __DIR__ . "/src/Config/Pokedex.php",
        new EliteFourChallengeRepository($db),
        new TrainerConfigRepository(),
        new LocationConfigRepository(),
        new InstanceId(Instance::DEFAULT_ID),
    ),
    new EventFactory(
        new ViewModelFactory(require __DIR__ . "/src/Config/Pokedex.php"),
        new PokedexConfigRepository(),
    )
);

$result = $useCase->run($argv[1], $argv[2]);

if (is_null($result)) {
    echo "It's a draw!" . PHP_EOL;

} else {
    echo "The winner is " . TrainerClass::getLabel($result->class) . " " . $result->name . PHP_EOL;
}
