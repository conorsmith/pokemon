<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\Commands;

final class CatchPokemonResult
{
    public static function sentToParty(): self
    {
        return new self("sentToParty");
    }

    public static function sentToBox(): self
    {
        return new self("sentToBox");
    }

    private function __construct(
        private readonly string $value,
    ) {}

    public function wasSentToParty(): bool
    {
        return $this->value === "sentToParty";
    }

    public function wasSentToBox(): bool
    {
        return $this->value === "sentToBox";
    }
}