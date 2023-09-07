<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Import\ConsoleCommands;

use ConorSmith\Pokemon\SharedKernel\Domain\Sex;
use Doctrine\DBAL\DriverManager;
use Exception;

final class Generate
{
    public function __invoke(array $args): void
    {
        if (count($args) < 1 || !in_array($args[0], ["sex"])) {
            echo PHP_EOL;
            echo "[ USAGE ]" . PHP_EOL;
            echo "php console.php generate [sex]" . PHP_EOL . PHP_EOL;
            exit;
        }

        if ($args[0] === "sex") {

            $db = DriverManager::getConnection([
                'dbname'   => $_ENV['DB_NAME'],
                'user'     => $_ENV['DB_USER'],
                'password' => $_ENV['DB_PASS'],
                'host'     => $_ENV['DB_HOST'],
                'driver'   => "pdo_mysql",
            ]);

            $rows = $db->fetchAllAssociative("SELECT * FROM caught_pokemon");

            foreach ($rows as $row) {
                $sex = self::generateEncounteredSex($row['pokemon_id']);
                $db->update("caught_pokemon", [
                    'sex' => match ($sex) {
                        Sex::FEMALE  => "F",
                        Sex::MALE    => "M",
                        Sex::UNKNOWN => "U",
                    },
                ], [
                    'id' => $row['id'],
                ]);
            }
        }
    }

    private static function generateEncounteredSex(string $pokedexNumber): Sex
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
}
