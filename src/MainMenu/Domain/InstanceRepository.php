<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Domain;

interface InstanceRepository
{
    public function all(): array;

    public function save(Instance $instance): void;
}
