<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\ConsoleCommands;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Trainer;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\EliteFourChallengeRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\LeagueChampionRepositoryDb;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\TrainerRepositoryDb;
use ConorSmith\Pokemon\Gameplay\App\UseCases\SimulateABattle;
use ConorSmith\Pokemon\LocationConfigRepository;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
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

        $trainerRepository = new TrainerRepositoryDb(
            $db,
            new EliteFourChallengeRepositoryDb(
                $db,
                new LeagueChampionRepositoryDb(
                    $db,
                    new InstanceId("8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1"),
                ),
                new InstanceId("8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1"),
            ),
            new LeagueChampionRepositoryDb(
                $db,
                new InstanceId("8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1"),
            ),
            new TrainerConfigRepository(),
            new LocationConfigRepository(),
            $pokemonConfigRepository,
            new InstanceId("8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1"),
        );

        $randomTrainerGenerator = new RandomTrainerGenerator(
            $pokemonConfigRepository,
            new TrainerConfigRepository(),
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
