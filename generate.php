<?php

declare(strict_types=1);

use ConorSmith\Pokemon\Sex;
use Doctrine\DBAL\DriverManager;

require_once __DIR__ . "/vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->load();

if ($argc < 2 || !in_array($argv[1], ["sex"])) {
    echo PHP_EOL;
    echo "[ USAGE ]" . PHP_EOL;
    echo "php generate.php [sex]" . PHP_EOL . PHP_EOL;
    exit;
}

if ($argv[1] === "sex") {

    $db = DriverManager::getConnection([
        'dbname'   => $_ENV['DB_NAME'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'host'     => $_ENV['DB_HOST'],
        'driver'   => "pdo_mysql",
    ]);

    $rows = $db->fetchAllAssociative("SELECT * FROM caught_pokemon");

    foreach ($rows as $row) {
        $sex = generateEncounteredSex($row['pokemon_id']);
        $db->update("caught_pokemon", [
            'sex' => match ($sex) {
                Sex::FEMALE => "F",
                Sex::MALE => "M",
                Sex::UNKNOWN => "U",
            },
        ], [
            'id' => $row['id'],
        ]);
    }
}

function generateEncounteredSex(string $pokedexNumber): Sex
{
    $pokedexConfigRepository = new \ConorSmith\Pokemon\PokedexConfigRepository();

    $pokedexConfig = $pokedexConfigRepository->find($pokedexNumber);

    if (count($pokedexConfig['sexRatio']) === 1) {
        return $pokedexConfig['sexRatio'][0]['sex'];
    }

    $aggregatedWeight = array_reduce(
        $pokedexConfig['sexRatio'],
        function ($carry, array $sexRatioEntry) {
            return $carry + $sexRatioEntry['weight'];
        },
        0,
    );

    $randomlySelectedValue = mt_rand(1, $aggregatedWeight);

    /** @var array $sexRatioEntry */
    foreach ($pokedexConfig['sexRatio'] as $sexRatioEntry) {
        $randomlySelectedValue -= $sexRatioEntry['weight'];
        if ($randomlySelectedValue <= 0) {
            return $sexRatioEntry['sex'];
        }
    }

    throw new Exception;
}
