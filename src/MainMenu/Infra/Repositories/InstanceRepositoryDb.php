<?php

declare(strict_types=1);

namespace ConorSmith\Pokemon\MainMenu\Infra\Repositories;

use Carbon\CarbonImmutable;
use ConorSmith\Pokemon\MainMenu\Domain\Instance;
use ConorSmith\Pokemon\MainMenu\Domain\InstanceRepository;
use ConorSmith\Pokemon\SharedKernel\InstanceId;
use Doctrine\DBAL\Connection;
use RuntimeException;

final class InstanceRepositoryDb implements InstanceRepository
{
    public function __construct(
        private readonly Connection $db,
    ) {}

    public function all(): array
    {
        $rows = $this->db->fetchAllAssociative("
            SELECT *
            FROM instances
        ");

        return array_map(
            fn(array $row) => new Instance(
                new InstanceId($row['id']),
                CarbonImmutable::createFromFormat(
                    "Y-m-d H:i:s",
                    $row['started_at'],
                    "Europe/Dublin",
                ),
                $row['current_location'],
            ),
            $rows,
        );
    }

    public function save(Instance $instance): void
    {
        $row = $this->db->fetchAssociative("
            SELECT *
            FROM instances
            WHERE id = :id
        ", [
            'id' => $instance->id->value,
        ]);

        if ($row !== false) {
            throw new RuntimeException();
        }

        $this->db->insert("instances", [
            'id'                => $instance->id->value,
            'started_at'        => $instance->startedAt,
            'current_location'  => $instance->currentLocation,
            'money'             => 0,
            'unused_level_ups'  => 0,
            'unused_moves'      => 0,
            'unused_encounters' => 0,
            'badges'            => json_encode([]),
            'active_battle_id'  => null,
        ]);
    }
}
