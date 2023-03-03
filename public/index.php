<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

define("INSTANCE_ID", "8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1");

$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

$db = \Doctrine\DBAL\DriverManager::getConnection([
    'dbname'   => "pokemon",
    'user'     => "pokemon",
    'password' => "password",
    'host'     => "localhost",
    'driver'   => "pdo_mysql",
]);

$pokedex = require __DIR__ . "/../src/Config/Pokedex.php";

/** @var array $map */
$map = require __DIR__ . "/../src/Config/Map.php";

$caughtPokemonRepository = new \ConorSmith\Pokemon\Repositories\CaughtPokemonRepository($db);
$trainerRepository = new \ConorSmith\Pokemon\Battle\Repositories\TrainerRepository($db, $pokedex, $map);
$dailyHabitLogRepository = new \ConorSmith\Pokemon\Habit\Repositories\DailyHabitLogRepository($db);
$pokemonRepository = new \ConorSmith\Pokemon\Team\Repositories\PokemonRepository(
    $db,
    new \ConorSmith\Pokemon\Player\EarnedGymBadgesQueryDb($db),
);
$friendshipLog = new \ConorSmith\Pokemon\Team\FriendshipLog($db);

$controllerFactory = new \ConorSmith\Pokemon\ControllerFactory(
    $db,
    $session,
    $caughtPokemonRepository,
    new \ConorSmith\Pokemon\Battle\Repositories\EncounterRepository(
        $db,
        $pokedex,
        $map,
        new \ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery($dailyHabitLogRepository),
    ),
    $trainerRepository,
    new \ConorSmith\Pokemon\Battle\Repositories\PlayerRepository(
        $db,
        new \ConorSmith\Pokemon\Team\TeamPokemonQuery($pokemonRepository),
        $pokedex,
    ),
    new \ConorSmith\Pokemon\Battle\Repositories\AreaRepository($trainerRepository),
    new \ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository($db),
    $dailyHabitLogRepository,
    new \ConorSmith\Pokemon\Habit\Repositories\UnlimitedHabitLogRepository($db),
    new \ConorSmith\Pokemon\Habit\Repositories\WeeklyHabitLogRepository($db),
    $pokemonRepository,
    $friendshipLog,
    new \ConorSmith\Pokemon\ViewModelFactory($pokedex),
    new \ConorSmith\Pokemon\Team\CatchPokemonCommand($db, $friendshipLog),
    new \ConorSmith\Pokemon\Habit\FoodDiaryHabitStreakQuery($dailyHabitLogRepository),
    new \ConorSmith\Pokemon\Team\FriendshipLogReportTeamPokemonFaintedCommand($friendshipLog),
    new \ConorSmith\Pokemon\Team\FriendshipLogReportBattleWithGymLeaderCommand($friendshipLog),
    new \ConorSmith\Pokemon\Team\WeeklyUpdateForTeamCommand($session, $pokemonRepository),
    $pokedex,
    $map,
);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($db, $session) {
    \ConorSmith\Pokemon\ControllerFactory::routes($r);
});

parse_str(parse_url($_SERVER['REQUEST_URI'])['query'] ?? "", $_GET);

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'])['path']);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo "Page Not Found";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $controllerFactory->create($handler)($vars);
        break;
}
