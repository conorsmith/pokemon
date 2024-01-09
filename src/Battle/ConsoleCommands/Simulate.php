<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ConsoleCommands;

use ConorSmith\Pokemon\Battle\Domain\Pokemon;
use ConorSmith\Pokemon\Battle\Domain\Trainer;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\SimulateABattle;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
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

        $pokemonConfigRepository = new PokedexConfigRepository();

        $trainerRepository = new TrainerRepository(
            $db,
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
            $pokemonConfigRepository,
            new InstanceId(Instance::DEFAULT_ID),
        );

        $randomTrainerGenerator = new RandomTrainerGenerator(
            $pokemonConfigRepository,
        );

        $useCase = new SimulateABattle(
            new EventFactory(
                new ViewModelFactory(
                    $pokemonConfigRepository,
                ),
                $pokemonConfigRepository,
            ),
        );

        if (isset($args[0])) {
            $trainerA = $trainerRepository->findTrainerByTrainerId($args[0]);
        } else {
            $trainerA = $randomTrainerGenerator->generate(
                RandomNumberGenerator::generateInRange(10, 100),
                LocationId::PALLET_TOWN,
            );
        }

        if (isset($args[1])) {
            $trainerB = $trainerRepository->findTrainerByTrainerId($args[1]);
        } else {
            $trainerB = $randomTrainerGenerator->generate(
                self::findHighestLevelOfPartyMembers($trainerA),
                LocationId::PALLET_TOWN,
            );
        }

        $result = $useCase->run($trainerA, $trainerB);

        if ($result->wasDraw) {
            echo "It's a draw!" . PHP_EOL;

        } else {
            echo "The winner is " . TrainerClass::getLabel($result->getWinningTrainer()->class) . " " . $result->getWinningTrainer()->name . PHP_EOL;
        }
    }

    private static function findHighestLevelOfPartyMembers(Trainer $trainer): int
    {
        $max = 0;

        /** @var Pokemon $partyMember */
        foreach ($trainer->party as $partyMember) {
            if ($partyMember->level > $max) {
                $max = $partyMember->level;
            }
        }

        return $max;
    }
}
