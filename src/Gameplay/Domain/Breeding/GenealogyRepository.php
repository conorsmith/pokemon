<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Gameplay\Domain\Breeding;

interface GenealogyRepository
{
    public function add(ParentalRelationship $parentalRelationship): void;
}
