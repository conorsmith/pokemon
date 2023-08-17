<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface ReduceEggCyclesCommand
{
    public function run(int $amount): void;
}
