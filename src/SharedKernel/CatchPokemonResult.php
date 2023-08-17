<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

final class CatchPokemonResult
{
    public static function sentToTeam(): self
    {
        return new self("sentToTeam");
    }

    public static function sentToBox(): self
    {
        return new self("sentToBox");
    }

    private function __construct(
        private readonly string $value,
    ) {}

    public function wasSentToTeam(): bool
    {
        return $this->value === "sentToTeam";
    }

    public function wasSentToBox(): bool
    {
        return $this->value === "sentToBox";
    }
}