<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Domain;

final class Notification
{
    public static function persistent(string $message): self
    {
        return new self($message, true);
    }

    public static function transient(string $message): self
    {
        return new self($message, false);
    }

    private function __construct(
        public readonly string $message,
        private readonly bool $isPersistent,
    ) {}

    public function isPersistent(): bool
    {
        return $this->isPersistent;
    }
}
