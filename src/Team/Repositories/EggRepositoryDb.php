<?php
declare(strict_types=1);

namespace ConorSmith\Pokemon\Team\Repositories;

use ConorSmith\Pokemon\Sex;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use ConorSmith\Pokemon\Team\Domain\Egg;
use ConorSmith\Pokemon\Team\Domain\EggRepository;
use Doctrine\DBAL\Connection;

final class EggRepositoryDb implements EggRepository
{
    public function __construct(
        private readonly Connection $db,
        private readonly InstanceId $instanceId,
    ) {}

    public function all(): array
    {
        $rows = $this->db->fetchAllAssociative("SELECT * FROM eggs WHERE instance_id = :instanceId", [
            'instanceId' => $this->instanceId->value,
        ]);

        $eggs = [];

        foreach ($rows as $row) {
            $eggs[] = new Egg(
                $row['first_parent_pokedex_number'],
                match ($row['first_parent_sex']) {
                    "F" => Sex::FEMALE,
                    "M" => Sex::MALE,
                    "U" => Sex::UNKNOWN,
                },
                $row['second_parent_pokedex_number'],
                match ($row['second_parent_sex']) {
                    "F" => Sex::FEMALE,
                    "M" => Sex::MALE,
                    "U" => Sex::UNKNOWN,
                },
                intval($row['remaining_cycles']),
            );
        }

        return $eggs;
    }
}
