<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

use ConorSmith\Pokemon\ItemId;

final class Bag
{
    public function __construct(
        public readonly array $items,
    ) {}

    public function has(string $id): bool
    {
        if (!array_key_exists($id, $this->items)) {
            return false;
        }

        return $this->items[$id]->quantity > 0;
    }

    public function count(string $id): int
    {
        if (!array_key_exists($id, $this->items)) {
            return 0;
        }

        return $this->items[$id]->quantity;
    }

    public function use(string $id, int $quantity = 1): self
    {
        $items = $this->items;

        $items[$id] = $items[$id]->use($quantity);

        return new self($items);
    }

    public function add(string $id, int $quantity = 1): self
    {
        $items = $this->items;

        if (!array_key_exists($id, $items)) {
            $items[$id] = new Item($id, 0);
        }

        $items[$id] = $items[$id]->add($quantity);

        return new self($items);
    }

    public function getEachPokeBall(): array
    {
        $filteredItems = [];

        if ($this->has(ItemId::POKE_BALL)) {
            $filteredItems[ItemId::POKE_BALL] = $this->items[ItemId::POKE_BALL];
        }

        if ($this->has(ItemId::GREAT_BALL)) {
            $filteredItems[ItemId::GREAT_BALL] = $this->items[ItemId::GREAT_BALL];
        }

        if ($this->has(ItemId::ULTRA_BALL)) {
            $filteredItems[ItemId::ULTRA_BALL] = $this->items[ItemId::ULTRA_BALL];
        }

        return $filteredItems;
    }

    public function hasAnyPokeBall(): bool
    {
        return $this->countAllPokeBalls() > 0;
    }

    public function countAllPokeBalls(): int
    {
        return $this->count(ItemId::POKE_BALL)
            + $this->count(ItemId::GREAT_BALL)
            + $this->count(ItemId::ULTRA_BALL);
    }

    public function countAllItems(): int
    {
        $total = 0;

        /** @var Item $item */
        foreach ($this->items as $item) {
            $total += $item->quantity;
        }

        return $total;
    }
}
