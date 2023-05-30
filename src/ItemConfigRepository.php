<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon;

final class ItemConfigRepository
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . "/Config/Items.php";
    }

    public function findByType(ItemType $itemType): array
    {
        return array_filter(
            $this->config,
            fn(array $configEntry) => isset($configEntry['type']) && $configEntry['type'] === $itemType,
        );
    }
}
