<?php
declare(strict_types=1);

require_once __DIR__ . "/../vendor/autoload.php";

define("INSTANCE_ID", "8a04a1fc-f9e9-4feb-98fc-470f90c8fdb1");

$httpKernel = \ConorSmith\Pokemon\ApplicationFactory::createHttpKernel();
$httpKernel();
