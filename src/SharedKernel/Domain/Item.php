<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

final class Item
{
    public function __construct(
        public readonly string $id,
        public readonly int $quantity,
        public readonly ?ItemType $type,
    ) {}

    public function use(int $quantity = 1): self
    {
        return new self(
            $this->id,
            $this->quantity - $quantity,
            $this->type,
        );
    }

    public function remove(int $quantity = 1): self
    {
        return new self(
            $this->id,
            $this->quantity - $quantity,
            $this->type,
        );
    }

    public function add(int $quantity = 1): self
    {
        return new self(
            $this->id,
            $this->quantity + $quantity,
            $this->type,
        );
    }
}
