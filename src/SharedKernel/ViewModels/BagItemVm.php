<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\ViewModels;

final class BagItemVm
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $imageUrl,
        public readonly string $amount,
        public readonly bool $hasUse,
        public readonly BagItemUseActionVm $useAction,
    ) {}
}
