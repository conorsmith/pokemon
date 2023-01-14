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

$controllerFactory = new \ConorSmith\Pokemon\ControllerFactory($db, $session, $caughtPokemonRepository, $pokedex, $map);

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($db, $session) {
    \ConorSmith\Pokemon\ControllerFactory::routes($r);
});

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
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
