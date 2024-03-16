<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\App\UseCases;

final class ResultOfStartingABattle
{
    public static function success(string $id): self
    {
        return new self($id);
    }

    public static function failure(): self
    {
        return new self(null);
    }

    private function __construct(
        public readonly ?string $id,
    ) {}

    public function succeeded(): bool
    {
        return !is_null($this->id);
    }
}
