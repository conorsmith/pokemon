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

$map = require __DIR__ . "/../src/Config/Map.php";

$caughtPokemonRepository = new \ConorSmith\Pokemon\Repositories\CaughtPokemonRepository($db);

if ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/food-diary"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogFoodDiary($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/food-diary"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogFoodDiary($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/team/level-up"
) {
    (new \ConorSmith\Pokemon\Controllers\GetTeamLevelUp($db, $caughtPokemonRepository, $pokedex))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/team/level-up"
) {
    (new \ConorSmith\Pokemon\Controllers\PostTeamLevelUp($db, $session, $pokedex))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/calorie-goal"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogCalorieGoal($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/calorie-goal"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogCalorieGoal($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/map/move"
) {
    (new \ConorSmith\Pokemon\Controllers\GetMapMove($db, $session, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/map/move"
) {
    (new \ConorSmith\Pokemon\Controllers\PostMapMove($db, $session, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/exercise"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogExercise($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/exercise"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogExercise($db, $session))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/map/encounter"
) {
    (new \ConorSmith\Pokemon\Controllers\GetMapEncounter($db, $session, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/map/encounter"
) {
    (new \ConorSmith\Pokemon\Controllers\PostMapEncounter($db, $session, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/box"
) {
    (new \ConorSmith\Pokemon\Controllers\GetBox($db, $pokedex))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/"
) {
    (new \ConorSmith\Pokemon\Controllers\GetIndex($session, $caughtPokemonRepository, $pokedex))();

} else {
    echo "Page Not Found";
    exit;
}
