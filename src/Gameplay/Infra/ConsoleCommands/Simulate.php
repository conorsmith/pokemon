<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\ConsoleCommands;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\Pokemon;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\Trainer;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Gameplay\App\UseCases\SimulateABattle;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\LocationId;
use ConorSmith\Pokemon\SharedKernel\Domain\RandomNumberGenerator;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\TrainerClass;
use ConorSmith\Pokemon\System\RepositoryFactory;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\DriverManager;
use Ramsey\Uuid\Uuid;

final class Simulate
{
    public function __invoke(array $args): void
    {
        if (!isset($args[0])) {
            echo "Instance ID required as first argument." . PHP_EOL;
            return;
        }

        if (!Uuid::isValid($args[0])) {
            echo "Given instance ID has invalid format." . PHP_EOL;
            return;
        }

        $instanceId = new InstanceId($args[0]);

        $db = DriverManager::getConnection([
            'dbname'   => $_ENV['DB_NAME'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host'     => $_ENV['DB_HOST'],
            'driver'   => "pdo_mysql",
        ]);

        $repositoryFactory = new RepositoryFactory($db, new DummySession());

        $pokemonConfigRepository = new PokedexConfigRepository();

        $trainerRepository = $repositoryFactory->create(TrainerRepository::class, $instanceId);

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

        if (isset($args[1])) {
            $trainerA = $trainerRepository->findTrainerByTrainerId($args[1]);
        } else {
            $trainerA = $randomTrainerGenerator->generate(
                RandomNumberGenerator::generateInRange(10, 100),
                LocationId::PALLET_TOWN,
            );
        }

        if (isset($args[2])) {
            $trainerB = $trainerRepository->findTrainerByTrainerId($args[2]);
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
