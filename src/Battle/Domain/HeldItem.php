<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Battle\Domain;

final class HeldItem
{
    public function __construct(
        public readonly string $id,
        public readonly ?int $typeEnhance,
    ) {}
}