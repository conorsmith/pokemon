<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Domain;

interface GenealogyRepository
{
    public function add(ParentalRelationship $parentalRelationship): void;
}
