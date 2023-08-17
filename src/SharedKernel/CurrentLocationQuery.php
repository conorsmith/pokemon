<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

interface CurrentLocationQuery
{
    public function run(): string;
}
