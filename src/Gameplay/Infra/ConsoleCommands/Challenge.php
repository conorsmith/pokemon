<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Infra\ConsoleCommands;

use ConorSmith\Pokemon\Gameplay\Domain\Battle\BattleRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\LeagueChampionRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\PlayerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\TrainerRepository;
use ConorSmith\Pokemon\Gameplay\Domain\Party\FriendshipEventLogRepository;
use ConorSmith\Pokemon\Gameplay\Infra\Endpoints\Battle\ViewModels\EventFactory;
use ConorSmith\Pokemon\Gameplay\Domain\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Gameplay\App\UseCases\GenerateAChallenge;
use ConorSmith\Pokemon\Gameplay\App\UseCases\SimulateABattle;
use ConorSmith\Pokemon\Gameplay\App\UseCases\StartABattle;
use ConorSmith\Pokemon\Gameplay\Infra\NotifyPlayerCommand;
use ConorSmith\Pokemon\Gameplay\Infra\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\MainMenu\Infra\InstanceRepositoryInstanceIdsQuery;
use ConorSmith\Pokemon\MainMenu\Infra\Repositories\InstanceRepositoryDb;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\System\RepositoryFactory;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use LogicException;

final class Challenge
{
    public function __invoke(array $args): void
    {
        $isBenchmark = isset($args[0]) && $args[0] === "--benchmark";
        $isDryRun = isset($args[0]) && $args[0] === "--dry-run";

        $tally = [
            'runs' => 0,
            'challenges' => 0,
        ];

        echo "Generating challenges" . PHP_EOL;
        echo PHP_EOL;

        $db = DriverManager::getConnection([
            'dbname'   => $_ENV['DB_NAME'],
            'user'     => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASS'],
            'host'     => $_ENV['DB_HOST'],
            'driver'   => "pdo_mysql",
        ]);

        $repositoryFactory = new RepositoryFactory($db, new DummySession());
        $pokemonConfigRepository = new PokedexConfigRepository();

        $instanceIds = self::allInstanceIds($db);

        /** @var InstanceId $instanceId */
        foreach ($instanceIds as $instanceId) {

            benchmarkRun:

            if ($isBenchmark && $tally['runs'] > 0) {
                echo "RUN #{$tally['runs']}" . PHP_EOL;
                echo "Challenges: {$tally['challenges']}" . PHP_EOL;
                $rate = $tally['challenges'] / $tally['runs'] * 100;
                echo "Rate:       {$rate}%" . PHP_EOL;
                echo PHP_EOL;
            }

            echo "Generating challenge for instance {$instanceId->value}" . PHP_EOL;
            echo PHP_EOL;

            $generateAChallenge = new GenerateAChallenge(
                $repositoryFactory->create(TrainerRepository::class, $instanceId),
                $repositoryFactory->create(EliteFourChallengeRepository::class, $instanceId),
                $repositoryFactory->create(LeagueChampionRepository::class, $instanceId),
                $repositoryFactory->create(BagRepository::class, $instanceId),
                new SimulateABattle(
                    new EventFactory(
                        new ViewModelFactory(
                            $pokemonConfigRepository,
                        ),
                        $pokemonConfigRepository,
                    ),
                ),
                new RandomTrainerGenerator(
                    $pokemonConfigRepository,
                    new TrainerConfigRepository(),
                ),
                new ViewModelFactory(
                    $pokemonConfigRepository,
                ),
            );

            $startABattle = new StartABattle(
                $repositoryFactory->create(BattleRepository::class, $instanceId),
                $repositoryFactory->create(FriendshipEventLogRepository::class, $instanceId),
                $repositoryFactory->create(PlayerRepository::class, $instanceId),
                $repositoryFactory->create(TrainerRepository::class, $instanceId),
            );

            $notifyPlayerCommand = new NotifyPlayerCommand(
                new NotificationRepositoryDbAndSession(
                    $db,
                    new DummySession(),
                    $instanceId
                )
            );

            $result = $generateAChallenge($isDryRun, $isBenchmark);

            if (!$result->wasGenerated) {
                echo "No challenge generated!" . PHP_EOL;
                echo PHP_EOL;
            } else {
                echo "Challenger for {$result->getRegionId()->value} championship" . PHP_EOL;
                echo PHP_EOL;
            }

            if ($isBenchmark) {
                $tally['runs']++;
                $tally['challenges'] += $result->wasGenerated ? 1 : 0;

                if ($tally['runs'] < 1000) {
                    goto benchmarkRun;
                } else {
                    echo "Benchmark complete" . PHP_EOL;
                    echo "Runs:       {$tally['runs']}" . PHP_EOL;
                    echo "Challenges: {$tally['challenges']}" . PHP_EOL;
                    $rate = $tally['challenges'] / $tally['runs'] * 100;
                    echo "Rate:       {$rate}%" . PHP_EOL;
                    echo PHP_EOL;
                    continue;
                }
            }

            if ($isDryRun) {
                echo "Dry run complete" . PHP_EOL;
                echo PHP_EOL;
                continue;
            }

            if (!$result->wasGenerated) {
                continue;
            }

            $challengeRegionName = match ($result->getRegionId()) {
                RegionId::KANTO => "Kanto",
                RegionId::JOHTO => "Johto",
                RegionId::HOENN => "Hoenn",
                default => throw new LogicException(),
            };

            $result = $startABattle($result->getTrainerId(), false);

            if ($result->succeeded()) {
                echo "Battle started!" . PHP_EOL;
                echo "Battle ID {$result->id}" . PHP_EOL;
            } else {
                echo "Battle failed to start!" . PHP_EOL;
            }

            $notifyPlayerCommand->run(
                Notification::persistent("You have been challenged for the {$challengeRegionName} championship!")
            );

            $notifyPlayerCommand->run(
                Notification::persistent("You received a Challenge Token")
            );

            echo PHP_EOL;
        }
    }

    private static function allInstanceIds(Connection $db): array
    {
        $instanceIdsQuery = new InstanceRepositoryInstanceIdsQuery(
            new InstanceRepositoryDb($db),
        );

        return $instanceIdsQuery->run();
    }
}
