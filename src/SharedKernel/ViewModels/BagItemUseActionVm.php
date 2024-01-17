<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel\ViewModels;

final class BagItemUseActionVm
{
    public function __construct(
        public readonly string $url,
        public readonly array $hiddenInputs,
    ) {}
}

