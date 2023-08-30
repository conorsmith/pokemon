<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ConsoleCommands;

use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\GenerateAChallenge;
use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\RepositoryFactory;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\Team\FriendshipLog;
use ConorSmith\Pokemon\Team\FriendshipLogReportBattleWithGymLeaderCommand;
use ConorSmith\PokemonTest\Support\Instance;
use Doctrine\DBAL\DriverManager;

final class Challenge
{
    public function __invoke(array $args): void
    {
        echo "Generating challenges" . PHP_EOL;
        echo PHP_EOL;

        $db = DriverManager::getConnection([
            'dbname'   => $_ENV['DB_NAME'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host'     => $_ENV['DB_HOST'],
            'driver'   => "pdo_mysql",
        ]);

        $repositoryFactory = new RepositoryFactory($db);

        $instanceIds = self::allInstanceIds();

        /** @var InstanceId $instanceId */
        foreach ($instanceIds as $instanceId) {

            echo "Generating challenge for instance {$instanceId->value}" . PHP_EOL;

            $generateAChallenge = new GenerateAChallenge(
                $repositoryFactory->create(TrainerRepository::class, $instanceId),
                $repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
            );

            $startABattle = new StartABattle(
                $repositoryFactory->create(BattleRepository::class, $instanceId),
                $repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $repositoryFactory->create(TrainerRepository::class, $instanceId),
                new FriendshipLogReportBattleWithGymLeaderCommand(new FriendshipLog($db)),
            );

            $result = $generateAChallenge();

            if (!$result->wasGenerated) {
                echo "No challenge generated!" . PHP_EOL;
                echo PHP_EOL;
                return;
            } else {
                echo "Challenger for {$result->getRegionId()->value} championship" . PHP_EOL;
            }

            $result = $startABattle($result->getTrainerId());

            if ($result->succeeded()) {
                echo "Battle started!" . PHP_EOL;
                echo "Battle ID {$result->id}" . PHP_EOL;
            } else {
                echo "Battle failed to start!" . PHP_EOL;
            }

            echo PHP_EOL;
        }
    }

    private static function allInstanceIds(): array
    {
        return [new InstanceId(Instance::DEFAULT_ID)];
    }
}