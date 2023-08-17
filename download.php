<?php

declare(strict_types=1);

use ConorSmith\Pokemon\LocationId;

require_once __DIR__ . "/vendor/autoload.php";

$locationIdReflector = new ReflectionClass(LocationId::class);
$locationIdConstants = array_flip($locationIdReflector->getConstants());

$config = include __DIR__ . "/src/Config/Maps/Hoenn.php";

$data = [];

foreach ($config as $locationId => $url) {
    $data[$locationId] = [
        'url' => $url,
        'filename' => explode("/", $url)[count(explode("/", $url)) - 1],
    ];
}

foreach ($data as $locationId => $datum) {
    if (!file_exists(__DIR__ . "/public/assets/maps/{$datum['filename']}")) {
        file_put_contents(
            __DIR__ . "/public/assets/maps/{$datum['filename']}",
            file_get_contents($datum['url'])
        );
    }
}

echo "<?php" . PHP_EOL;
echo "declare(strict_types=1);" . PHP_EOL;
echo PHP_EOL;
echo "use ConorSmith\Pokemon\LocationId;" . PHP_EOL;
echo PHP_EOL;
echo "return [" . PHP_EOL;

foreach ($data as $locationId => $datum) {
    echo "    LocationId::{$locationIdConstants[$locationId]} => \"{$datum['filename']}\"," . PHP_EOL;
}

echo "];" . PHP_EOL;