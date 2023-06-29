<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\SharedKernel;

final class InstanceId
{
    public function __construct(
        public readonly string $value,
    ) {}
}
