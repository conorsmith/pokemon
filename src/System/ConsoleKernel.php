<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\System;

use ConorSmith\Pokemon\Battle\ConsoleCommands\Challenge;
use ConorSmith\Pokemon\Battle\ConsoleCommands\Simulate;
use ConorSmith\Pokemon\Import\ConsoleCommands\Convert;
use ConorSmith\Pokemon\Import\ConsoleCommands\Download;
use ConorSmith\Pokemon\Import\ConsoleCommands\Generate;
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
            "challenge" => (new Challenge())(array_slice($argv, 2)),
            "convert"   => (new Convert())(array_slice($argv, 2)),
            "download"  => (new Download())(array_slice($argv, 2)),
            "generate"  => (new Generate())(array_slice($argv, 2)),
            "import"    => (new Import())(array_slice($argv, 2)),
            "simulate"  => (new Simulate())(array_slice($argv, 2)),
            default     => self::handleUnknownCommand($command),
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
