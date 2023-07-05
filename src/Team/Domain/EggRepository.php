<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Domain;

interface EggRepository
{
    public function all(): array;
}
