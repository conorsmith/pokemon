<?php

declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

(Dotenv\Dotenv::createImmutable(__DIR__ . "/.."))->load();

$httpKernel = \ConorSmith\Pokemon\ApplicationFactory::createHttpKernel();
$response = $httpKernel(\Symfony\Component\HttpFoundation\Request::createFromGlobals());

$response->send();
