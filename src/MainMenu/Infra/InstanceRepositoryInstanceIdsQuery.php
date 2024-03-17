<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Infra;

use ConorSmith\Pokemon\MainMenu\Domain\Instance;
use ConorSmith\Pokemon\MainMenu\Domain\InstanceRepository;
use ConorSmith\Pokemon\SharedKernel\Queries\InstanceIdsQuery;

final class InstanceRepositoryInstanceIdsQuery implements InstanceIdsQuery
{
    public function __construct(
        private readonly InstanceRepository $instanceRepository,
    ) {}

    public function run(): array
    {
        return array_map(
            fn(Instance $instance) => $instance->id,
            $this->instanceRepository->all(),
        );
    }
}
