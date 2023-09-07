<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

interface EggRepository
{
    public function all(): array;
    public function save(Egg $egg): void;
    public function remove(Egg $egg): void;
}
