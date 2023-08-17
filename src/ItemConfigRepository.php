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

    public function find(string $id): ?array
    {
        if (!array_key_exists($id, $this->config)) {
            return null;
        }

        return $this->config[$id];
    }

    public function findByType(ItemType $itemType): array
    {
        return array_filter(
            $this->config,
            fn(array $configEntry) => isset($configEntry['type']) && $configEntry['type'] === $itemType,
        );
    }
}
