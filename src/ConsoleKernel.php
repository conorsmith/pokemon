<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon;

use ConorSmith\Pokemon\Import\ConsoleCommands\Import;

final class ConsoleKernel
{
    public function __invoke(array $argv): void
    {
        if (count($argv) < 2) {
            self::handleMissingCommand();
            return;
        }

        $command = $argv[1];

        match ($command) {
            "import" => (new Import())(array_slice($argv, 2)),
            default  => self::handleUnknownCommand($command),
        };
    }

    private static function handleMissingCommand(): void
    {
        echo PHP_EOL;
        echo "Missing command" . PHP_EOL;
        echo PHP_EOL;
        echo "[ USAGE ]" . PHP_EOL;
        echo "php console.php [command] (args)" . PHP_EOL;
        echo PHP_EOL;
    }

    private static function handleUnknownCommand(string $command): void
    {
        echo PHP_EOL;
        echo "Unknown command '{$command}'" . PHP_EOL;
        echo PHP_EOL;
        echo "[ USAGE ]" . PHP_EOL;
        echo "php console.php [command] (args)" . PHP_EOL;
        echo PHP_EOL;
    }
}
