<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

define("INSTANCE_ID", "8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1");

$db = \Doctrine\DBAL\DriverManager::getConnection([
    'dbname'   => "pokemon",
    'user'     => "pokemon",
    'password' => "password",
    'host'     => "localhost",
    'driver'   => "pdo_mysql",
]);

$pokedex = [
    "1" => [
        'name'     => "Bulbasaur",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/001.png",
    ],
    "4" => [
        'name'     => "Charmander",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/004.png",
    ],
    "7" => [
        'name'     => "Squirtle",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/007.png",
    ],
    "16" => [
        'name'     => "Pidgey",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/016.png",
    ],
    "19" => [
        'name'     => "Rattata",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/019.png",
    ],
    "114" => [
        'name'     => "Tangela",
        'imageUrl' => "https://assets.pokemon.com/assets/cms2/img/pokedex/full/114.png",
    ],
];

$map = include __DIR__ . "/../src/Config/Map.php";

$caughtPokemonRepository = new \ConorSmith\Pokemon\Repositories\CaughtPokemonRepository($db);

if ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/food-diary"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogFoodDiary())();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/food-diary"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogFoodDiary($db))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/team/level-up"
) {
    (new \ConorSmith\Pokemon\Controllers\GetTeamLevelUp($db, $caughtPokemonRepository, $pokedex))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/team/level-up"
) {
    (new \ConorSmith\Pokemon\Controllers\PostTeamLevelUp($db))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/calorie-goal"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogCalorieGoal())();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/calorie-goal"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogCalorieGoal($db))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/map/move"
) {
    (new \ConorSmith\Pokemon\Controllers\GetMapMove($db, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/map/move"
) {
    (new \ConorSmith\Pokemon\Controllers\PostMapMove($db, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/log/exercise"
) {
    (new \ConorSmith\Pokemon\Controllers\GetLogExercise())();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/log/exercise"
) {
    (new \ConorSmith\Pokemon\Controllers\PostLogExercise($db))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/map/encounter"
) {
    (new \ConorSmith\Pokemon\Controllers\GetMapEncounter($db, $map))();

} elseif ($_SERVER['REQUEST_METHOD'] === "POST"
    && $_SERVER['REQUEST_URI'] === "/map/encounter"
) {
    (new \ConorSmith\Pokemon\Controllers\PostMapEncounter($db, $map, $pokedex))();

} elseif ($_SERVER['REQUEST_METHOD'] === "GET"
    && $_SERVER['REQUEST_URI'] === "/"
) {
    (new \ConorSmith\Pokemon\Controllers\GetIndex($caughtPokemonRepository, $pokedex))();

} else {
    echo "Page Not Found";
    exit;
}
