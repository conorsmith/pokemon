<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

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
}
