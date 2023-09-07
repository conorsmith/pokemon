<?php

declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__))->load();

$consoleKernel = \ConorSmith\Pokemon\System\ApplicationFactory::createConsoleKernel();
$consoleKernel($argv);
