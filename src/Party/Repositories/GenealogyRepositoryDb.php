<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\Party\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\Party\Domain\GenealogyRepository;
use ConorSmith\Pokemon\Party\Domain\ParentalRelationship;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;

final class GenealogyRepositoryDb implements GenealogyRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function add(ParentalRelationship $parentalRelationship): void
    {
        $this->db->insert("parental_relationships", [
            'instance_id'      => $this->instanceId->value,
            'subject_id'       => $parentalRelationship->subjectId,
            'first_parent_id'  => $parentalRelationship->firstParentId,
            'second_parent_id' => $parentalRelationship->secondParentId,
            'date_born'        => CarbonImmutable::now("Europe/Dublin"),
        ]);
    }
}
