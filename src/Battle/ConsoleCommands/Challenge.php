<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\ConsoleCommands;

use ConorSmith\Pokemon\Battle\Domain\BattleRepository;
use ConorSmith\Pokemon\Battle\EventFactory;
use ConorSmith\Pokemon\Battle\RandomTrainerGenerator;
use ConorSmith\Pokemon\Battle\Repositories\EliteFourChallengeRepository;
use ConorSmith\Pokemon\Battle\Repositories\LeagueChampionRepository;
use ConorSmith\Pokemon\Battle\Repositories\PlayerRepositoryDb;
use ConorSmith\Pokemon\Battle\Repositories\TrainerRepository;
use ConorSmith\Pokemon\Battle\UseCases\GenerateAChallenge;
use ConorSmith\Pokemon\Battle\UseCases\SimulateABattle;
use ConorSmith\Pokemon\Battle\UseCases\StartABattle;
use ConorSmith\Pokemon\Party\FriendshipLog;
use ConorSmith\Pokemon\Party\FriendshipLogReportBattleWithGymLeaderCommand;
use ConorSmith\Pokemon\Player\NotifyPlayerCommand;
use ConorSmith\Pokemon\Player\Repositories\NotificationRepositoryDbAndSession;
use ConorSmith\Pokemon\PokedexConfigRepository;
use ConorSmith\Pokemon\SharedKernel\Domain\Notification;
use ConorSmith\Pokemon\SharedKernel\Domain\RegionId;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\SharedKernel\Repositories\BagRepository;
use ConorSmith\Pokemon\System\RepositoryFactory;
use ConorSmith\Pokemon\TrainerConfigRepository;
use ConorSmith\Pokemon\ViewModelFactory;
use ConorSmith\PokemonTest\Support\Instance;
use Doctrine\DBAL\DriverManager;
use LogicException;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\FlashBagAwareSessionInterface;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\Storage\MetadataBag;

final class Challenge
{
    public function __invoke(array $args): void
    {
        $isBenchmark = isset($args[0]) && $args[0] === "--benchmark";
        $isDryRun = isset($args[0]) && $args[0] === "--dry-run";

        if ($isBenchmark) {
            $tally = [
                'runs' => 0,
                'challenges' => 0,
            ];
        }

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
        $pokemonConfigRepository = new PokedexConfigRepository();

        $instanceIds = self::allInstanceIds();

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
                $repositoryFactory->create(PlayerRepositoryDb::class, $instanceId),
                $repositoryFactory->create(TrainerRepository::class, $instanceId),
                new FriendshipLogReportBattleWithGymLeaderCommand(new FriendshipLog($db)),
            );

            $notifyPlayerCommand = new NotifyPlayerCommand(
                new NotificationRepositoryDbAndSession(
                    $db,
                    self::createDummySession(),
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

    private static function allInstanceIds(): array
    {
        return [new InstanceId(Instance::DEFAULT_ID)];
    }

    private static function createDummySession(): FlashBagAwareSessionInterface
    {
        return new class implements FlashBagAwareSessionInterface
        {
            public function getFlashBag(): FlashBagInterface
            {
                return new class implements FlashBagInterface
                {

                    public function add(string $type, mixed $message)
                    {
                        //
                    }

                    public function get(string $type, array $default = []): array
                    {
                        return $default;
                    }

                    public function set(string $type, string|array $messages)
                    {
                        throw new LogicException();
                    }

                    public function peek(string $type, array $default = []): array
                    {
                        throw new LogicException();
                    }

                    public function peekAll(): array
                    {
                        throw new LogicException();
                    }

                    public function all(): array
                    {
                        throw new LogicException();
                    }

                    public function setAll(array $messages)
                    {
                        throw new LogicException();
                    }

                    public function has(string $type): bool
                    {
                        throw new LogicException();
                    }

                    public function keys(): array
                    {
                        throw new LogicException();
                    }

                    public function getName(): string
                    {
                        throw new LogicException();
                    }

                    public function initialize(array &$array)
                    {
                        throw new LogicException();
                    }

                    public function getStorageKey(): string
                    {
                        throw new LogicException();
                    }

                    public function clear(): mixed
                    {
                        throw new LogicException();
                    }
                };
            }
            public function start(): bool
            {
                throw new LogicException();
            }

            public function getId(): string
            {
                throw new LogicException();
            }

            public function setId(string $id)
            {
                throw new LogicException();
            }

            public function getName(): string
            {
                throw new LogicException();
            }

            public function setName(string $name)
            {
                throw new LogicException();
            }

            public function invalidate(int $lifetime = null): bool
            {
                throw new LogicException();
            }

            public function migrate(bool $destroy = false, int $lifetime = null): bool
            {
                throw new LogicException();
            }

            public function save()
            {
                throw new LogicException();
            }

            public function has(string $name): bool
            {
                throw new LogicException();
            }

            public function get(string $name, mixed $default = null): mixed
            {
                throw new LogicException();
            }

            public function set(string $name, mixed $value)
            {
                throw new LogicException();
            }

            public function all(): array
            {
                throw new LogicException();
            }

            public function replace(array $attributes)
            {
                throw new LogicException();
            }

            public function remove(string $name): mixed
            {
                throw new LogicException();
            }

            public function clear()
            {
                throw new LogicException();
            }

            public function isStarted(): bool
            {
                throw new LogicException();
            }

            public function registerBag(SessionBagInterface $bag)
            {
                throw new LogicException();
            }

            public function getBag(string $name): SessionBagInterface
            {
                throw new LogicException();
            }

            public function getMetadataBag(): MetadataBag
            {
                throw new LogicException();
            }
        };
    }
}
